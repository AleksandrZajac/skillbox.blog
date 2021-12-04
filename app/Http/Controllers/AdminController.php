<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleHistory;
use App\Models\Comment;
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
        $numberOfArticlesPerUser = 1;
        $articlesCount = $this->portalStatistics->getArticlesCount();
        $newsCount = $this->portalStatistics->getNewsCount();
        $userNameWhereArticleCountMax = $this->portalStatistics->getUserNameWhereArticleCountMax();

        if (Article::first()) {
            $longestArticle = $this->portalStatistics->getLongestArticle();
        } else {
            $longestArticle = new Article();
            $longestArticle->title = '';
            $longestArticle->slug = '';
        }

        if (Article::first()) {
        $shortestArticle = $this->portalStatistics->getShortestArticle();
        } else {
            $shortestArticle = new Article();
            $shortestArticle->title = '';
            $shortestArticle->slug = '';
        }

        $averageNumberOfArticlesByActiveUsers = $this->portalStatistics->getAverageNumberOfArticlesByActiveUsers($numberOfArticlesPerUser);

        if (ArticleHistory::first()) {
            $mostVolatileArticle = $this->portalStatistics->getMostVolatileArticle();
        } else {
            $mostVolatileArticle = new Article();
            $mostVolatileArticle->title = '';
            $mostVolatileArticle->slug = '';
        }

        if (Comment::first()) {
            $mostDiscussedArticle = $this->portalStatistics->getMostDiscussedArticle();
        } else {
            $mostDiscussedArticle = new Article();
            $mostDiscussedArticle->title = '';
            $mostDiscussedArticle->slug = '';
        }

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
