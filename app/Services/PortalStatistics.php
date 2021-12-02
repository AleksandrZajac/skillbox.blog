<?php

namespace App\Services;

use App\Models\Article;
use App\Models\News;
use App\Models\User;
use App\Models\Comment;
use App\Models\ArticleHistory;
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

        return [
            'title' => $article->title,
            'link' => route('articles.show', $article->slug),
            'length' => $article->description_length,
        ];
    }

    public function getShortestArticle()
    {
        $article = DB::table('articles')
            ->select(DB::raw('LENGTH(description) As description_length, title, slug'))
            ->orderBy('description_length')
            ->first();

        return [
            'title' => $article->title,
            'link' => route('articles.show', $article->slug),
            'length' => $article->description_length,
        ];
    }

    public function getAverageNumberOfArticlesByActiveUsers()
    {
        $numberOfArticlesPerUser = 1;

        return DB::table('articles')
            ->select(DB::raw('COUNT(*) as count'))
            ->groupBy('owner_id')
            ->havingRaw('count > ?', [$numberOfArticlesPerUser])
            ->avg('count');
    }

    public function getMostVolatileArticle()
    {
        if (ArticleHistory::first()) {
            $article = ArticleHistory::selectRaw('article_id, count(*) as count_articles')
                ->groupBy('article_id')
                ->orderByDesc('count_articles')
                ->first()
                ->article;

            return [
                'title' => $article->title,
                'link' => route('articles.show', $article->slug),
            ];
        }

        return [
            'title' => '',
            'link' => '',
        ];
    }

    public function getMostDiscussedArticle()
    {
        if (Comment::first()) {
            $articleId = Comment::where('commentable_type', Article::class)
                ->selectRaw('commentable_id, count(*) as count_comments')
                ->groupBy('commentable_id')
                ->orderByDesc('count_comments')
                ->first()
                ->commentable_id;

            $article = Article::find($articleId);

            return [
                'title' => $article->title,
                'link' => route('articles.show', $article->slug),
            ];
        }

        return [
            'title' => '',
            'link' => '',
        ];
    }
}
