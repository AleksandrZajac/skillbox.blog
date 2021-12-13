<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexArticles(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->paginate(10);

        return view('articles.index', compact('articles'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNews(Tag $tag)
    {
        $news= $tag->news()->with('tags')->paginate(10);

        return view('news.index', compact('news'));
    }
}
