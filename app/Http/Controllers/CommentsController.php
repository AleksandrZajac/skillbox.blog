<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
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
    public function create(Article $article)
    {
        return view('comments.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Article $article)
    {
        $comment = new Comment();
        $comment->description = request('description');
        $comment->article_id = $article->id;
        $comment->owner_id = auth()->id();

        $comment->save();

        return redirect()->route('articles.show', $article->slug)->with('success', 'Comment created successfully.');
    }
}
