<?php

namespace App\Http\Controllers;

use App\Notifications\ArticleNotificationCreated;
use App\Notifications\ArticleNotificationDeleted;
use App\Notifications\ArticleNotificationUpdated;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Services\TagsSynchronizer;
use Illuminate\Support\Facades\Notification;
use App\Services\PushAll;

class ArticleController extends Controller
{
    private $tagsSynchronizer;
    private $PushAll;

    public function __construct(TagsSynchronizer $tagsSynchronizer, PushAll $pushAll)
    {
        $this->tagsSynchronizer = $tagsSynchronizer;
        $this->middleware('auth')->except(['index']);
        $this->middleware('can:update,article')->except(['index', 'store', 'show', 'create']);
        $this->middleware('can:delete,article')->only(['destroy']);
        $this->pushAll = $pushAll;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->isPublished()->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Article();

        return view('articles.edit', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ArticleReques  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->slug = request('slug');
        $article->title = request('title');
        $article->short_description = request('short_description');
        $article->description = request('description');
        $article->is_published = (bool)request('is_published');
        $article->owner_id = auth()->id();

        $article->save();

        $tags = collect(explode(',', request('tags')));

        $this->tagsSynchronizer->sync($tags, $article);

        Notification::route('mail', config('mail.to.admin'))
            ->notify(new ArticleNotificationCreated($article, $this->pushAll));

        return redirect()->route('articles.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        $tags = collect(explode(',', request('tags')));

        $this->tagsSynchronizer->sync($tags, $article);

        Notification::route('mail', config('mail.to.admin'))->notify(new ArticleNotificationUpdated($article));

        return redirect()->route('articles.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        Notification::route('mail', config('mail.to.admin'))->notify(new ArticleNotificationDeleted($article));

        return redirect()->route('articles.index')
            ->with('success', 'post deleted successfully');
    }
}
