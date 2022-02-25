<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\News;
use Illuminate\Http\Request;
use App\Services\PortalStatistics;
use App\Services\GeneralReports;
use App\Jobs\GeneralReport;

class AdminController extends Controller
{
    private $portalStatistics;
    private $generalReports;

    public function __construct(PortalStatistics $portalStatistics, GeneralReports $generalReports)
    {
        $this->middleware('can:admin');
        $this->portalStatistics = $portalStatistics;
        $this->generalReports = $generalReports;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request('page') ?? '1';

        $articles = \Cache::tags(['articles'])->remember('uses_admin_articles|' . $page, 3600, function () {
            return Article::latest()->paginate(20);
        });

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
        $article = \Cache::tags(['article'])->remember('show_article_history|' . $article->id, 3600, function () use ($article) {
            return $article;
        });

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
        $page = request('page') ?? '1';

        $news = \Cache::tags(['news'])->remember('uses_admin_news|' . $page, 3600 , function () {
            return News::latest()->paginate(20);ished()->paginate(10);
        });

        //$news = News::latest()->paginate(20);

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
        $newsCount = \Cache::tags(['news'])->remember('news_count|', 3600, function () {
            return $this->portalStatistics->getNewsCount();
        });

        $articleStatistics = \Cache::tags(['article'])->remember('article_statistics|', 3600, function () {

            $articlesCount = $this->portalStatistics->getArticlesCount();
            $userNameWhereArticleCountMax = $this->portalStatistics->getUserNameWhereArticleCountMax();
            $longestArticle = $this->portalStatistics->getLongestArticle();
            $shortestArticle = $this->portalStatistics->getShortestArticle();
            $averageNumberOfArticlesByActiveUsers = $this->portalStatistics->getAverageNumberOfArticlesByActiveUsers();
            $mostVolatileArticle = $this->portalStatistics->getMostVolatileArticle();
            $mostDiscussedArticle = $this->portalStatistics->getMostDiscussedArticle();

            return [
                'articlesCount' => $articlesCount,
                'userNameWhereArticleCountMax' => $userNameWhereArticleCountMax,
                'longestArticle' => $longestArticle,
                'shortestArticle' => $shortestArticle,
                'averageNumberOfArticlesByActiveUsers' => $averageNumberOfArticlesByActiveUsers,
                'mostVolatileArticle' => $mostVolatileArticle,
                'mostDiscussedArticle' => $mostDiscussedArticle,
            ];
        });

        return view('portal.statistics', compact('newsCount', 'articleStatistics'));
    }

    public function createReports()
    {
        return view('reports.general');
    }

    public function sendReports(Request $request)
    {
        GeneralReport::dispatch($this->generalReports->getData());

        return redirect()->route('articles.index')->with('success', 'Отчет отправлен на ваш е-мейл');
    }
}
