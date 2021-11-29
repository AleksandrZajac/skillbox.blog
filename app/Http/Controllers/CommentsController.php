<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use App\Models\News;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createArticleComment(Article $article)
    {
        return view('comments.article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeArticleComment(Article $article)
    {
        $comment = new Comment();
        $comment->description = request('description');
        $comment->commentable_id = $article->id;
        $comment->commentable_type = Article::class;
        $comment->owner_id = auth()->id();

        $comment->save();

        return redirect()->route('articles.show', $article->slug)->with('success', 'Comment was created successfully.');
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNewsComment(News $news)
    {
        return view('comments.news.create', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNewsComment(News $news)
    {
        $comment = new Comment();
        $comment->description = request('description');
        $comment->commentable_id = $news->id;
        $comment->commentable_type = News::class;
        $comment->owner_id = auth()->id();

        $comment->save();

        return redirect()->route('news.show', $news->id)->with('success', 'Comment was created successfully.');
    }
}
