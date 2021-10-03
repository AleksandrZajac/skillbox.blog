<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class OwnerArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->where('owner_id', auth()->user()->id)->get();

        return view('articles.index', compact('articles'));
    }
}
