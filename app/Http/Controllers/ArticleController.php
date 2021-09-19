<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ArticleNotificationCreated;
use App\Notifications\ArticleNotificationDeleted;
use App\Notifications\ArticleNotificationUpdated;
use App\Models\Article;
use App\Models\Tag;
use App\Http\Requests\ArticleRequest;
use App\Services\TagsSynchronizer;
use App\Events\ArticleCreated;

class ArticleController extends Controller
{
    private $tagsSynchronizer;

    public function __construct(TagsSynchronizer $tagsSynchronizer)
    {
        $this->tagsSynchronizer = $tagsSynchronizer;
        $this->middleware('auth')->except(['index']);
        $this->middleware('can:update,article')->except(['index', 'store', 'show', 'create']);
        $this->middleware('can:delete,article')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->get();

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
    public function store(ArticleRequest $request, User $user)
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

        $user->admin()->notify(new ArticleNotificationCreated($article->title, $article->slug));

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
        return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article, User $user)
    {
        $article->update($request->all());

        $tags = collect(explode(',', request('tags')));

        $this->tagsSynchronizer->sync($tags, $article);

        $user->admin()->notify(new ArticleNotificationUpdated($article->title, $article->slug));

        return redirect()->route('articles.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
      * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, User $user)
    {
        $article->delete();

        $user->admin()->notify(new ArticleNotificationDeleted($article->title, $article->slug));

        return redirect()->route('articles.index')
                        ->with('success','post deleted successfully');
    }
}
