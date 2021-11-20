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
    public function create()
    {
        $articleSlug = substr(\Request::getRequestUri(), 1, -16);

        return view('comments.create', compact('articleSlug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $articleSlug = request('article_slug');
        $articleId = Article::where('slug', $articleSlug)->get()->first()->id;

        $comment = new Comment();
        $comment->description = request('description');
        $comment->article_id = $articleId;
        $comment->owner_id = auth()->id();

        $comment->save();

        return redirect()->route('articles.show', $articleSlug)->with('success', 'Comment created successfully.');
    }
}
