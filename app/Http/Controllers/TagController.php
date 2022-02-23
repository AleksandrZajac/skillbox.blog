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
        $page = request('page') ?? '1';

        $articles = \Cache::tags(['articles'])->remember('tags_articles|' . $page, 3600, function () use ($tag) {
            return $tag->articles()->with('tags')->paginate(10);
        });

        return view('articles.index', compact('articles'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNews(Tag $tag)
    {
        $page = request('page') ?? '1';

        $news = \Cache::tags(['news'])->remember('tags_news|' . $page, 3600, function () use ($tag) {
            return $tag->news()->with('tags')->paginate(10);
        });

        return view('news.index', compact('news'));
    }
}
