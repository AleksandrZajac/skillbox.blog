<?php

namespace App\Http\Controllers;

use App\Notifications\ArticleNotificationCreated;
use App\Notifications\ArticleNotificationDeleted;
use App\Notifications\ArticleNotificationUpdated;
use App\Models\Article;
use App\Models\User;
use App\Http\Requests\ArticleRequest;
use App\Services\WebSocket;
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
        $page = request('page') ?? '1';

        $articles = \Cache::tags(['articles'])->remember('uses_articles|' . $page, 3600, function () {
            return Article::latest()->isPublished()->paginate(10);
        });

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
     * @param  App\Http\Requests\ArticleRequest  $request
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

        $this->tagsSynchronizer->sync(request('tags'), $article);

        $user = User::find(auth()->id());
        $user->notify(new ArticleNotificationCreated($article, $this->pushAll));

        return redirect()->route('articles.index')->with('success', 'Post was created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article = \Cache::tags(['article'])->remember('show_article|' . $article->id, 3600, function () use ($article) {
            return $article;
        });

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

        $this->tagsSynchronizer->sync(request('tags'), $article);

        WebSocket::user()->notify(new ArticleNotificationUpdated($article));

        return redirect()->route('articles.show', $article->slug)->with('success', 'Post was updated successfully');
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
            ->with('success', 'Post was deleted successfully');
    }
}
