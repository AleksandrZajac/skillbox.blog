<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleHistory;
use App\Models\News;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PortalStatistics;

class AdminController extends Controller
{
    private $portalStatistics;

    public function __construct(PortalStatistics $portalStatistics)
    {
        $this->middleware('can:admin');
        $this->portalStatistics = $portalStatistics;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(20);

        return view('articles.index', compact('articles'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function history(Article $article)
    {
        return view('articles.history', compact('article'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function news()
    {
        $news = News::latest()->paginate(20);

        return view('news.index', compact('news'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function portalStatistics()
    {
        $articlesCount = $this->portalStatistics->getArticlesCount();
        $newsCount = $this->portalStatistics->getNewsCount();
        $userNameWhereArticleCountMax = $this->portalStatistics->getUserNameWhereArticleCountMax();
        $longestArticle = $this->portalStatistics->getLongestArticle();
        $shortestArticle = $this->portalStatistics->getShortestArticle();
        $averageNumberOfArticlesByActiveUsers = $this->portalStatistics->getAverageNumberOfArticlesByActiveUsers();
        $mostVolatileArticle = $this->portalStatistics->getMostVolatileArticle();
        $mostDiscussedArticle = $this->portalStatistics->getMostDiscussedArticle();

        return view('portal.statistics', compact(
            'articlesCount',
            'newsCount',
            'userNameWhereArticleCountMax',
            'longestArticle',
            'shortestArticle',
            'averageNumberOfArticlesByActiveUsers',
            'mostVolatileArticle',
            'mostDiscussedArticle',
        ));
    }
}
