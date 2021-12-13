<?php

namespace App\Services;

use App\Models\Article;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PortalStatistics
{
    public function getArticlesCount()
    {
        return Article::count();
    }

    public function getNewsCount()
    {
        return News::count();
    }

    public function getUserNameWhereArticleCountMax()
    {
        return User::withCount('articles')->first()->name;
    }

    public function getLongestArticle()
    {
        $article = DB::table('articles')
            ->select(DB::raw('LENGTH(description) As description_length, title, slug'))
            ->orderByDesc('description_length')
            ->first();

        return $article ?? null;
    }

    public function getShortestArticle()
    {
        $article = DB::table('articles')
            ->select(DB::raw('LENGTH(description) As description_length, title, slug'))
            ->orderBy('description_length')
            ->first();

        return $article ?? null;
    }

    public function getAverageNumberOfArticlesByActiveUsers()
    {
        $article = DB::table('articles')
            ->select(DB::raw('COUNT(*) as total'))
            ->groupBy('owner_id')
            ->havingRaw('total >= ?', [config('services.portal_statistics.articles.count')])
            ->avg('total');

        return $article;
    }

    public function getMostVolatileArticle()
    {
        $article = DB::table('article_histories')
            ->select('article_id', 'articles.title', 'articles.slug', DB::raw('count(*) as total'))
            ->join('articles', 'article_histories.article_id', '=',  'articles.id')
            ->groupBy('article_id')
            ->orderBy('total', 'DESC')
            ->first();

        return $article ?? null;
    }

    public function getMostDiscussedArticle()
    {
        $article = DB::table('articles')
            ->select('articles.title', 'articles.slug', DB::raw('count(commentable_id) as total'))
            ->join('comments', 'articles.id', '=', 'commentable_id')
            ->where('commentable_type', 'App\Models\Article')
            ->groupBy('commentable_id')
            ->orderBy('total', 'DESC')
            ->first();

        return $article ?? null;
    }
}
