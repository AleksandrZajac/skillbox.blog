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
    private $result = [];

    public function collection()
    {
        $this->articlesCount();
        $this->newsCount();
        $this->userNameWhereArticleCountMax();
        $this->longestArticle();
        $this->shortestArticle();
        $this->averageNumberOfArticlesByActiveUsers();
        $this->mostVolatileArticle();
        $this->mostDiscussedArticle();

        return $this->result;
    }

    public function articlesCount()
    {
        $this->result[] = [
            'Количество статей:' => Article::count(),
        ];
    }

    public function newsCount()
    {
        $this->result[] = [
            'Количество новостей:' => News::count(),
        ];
    }

    public function userNameWhereArticleCountMax()
    {
        $this->result[] = [
            'ФИО автора, у которого больше всего статей на сайте:' => User::withCount('articles')->first()->name,
        ];
    }

    public function longestArticle()
    {
        $article = DB::table('articles')
            ->select(DB::raw('LENGTH(description) As description_length, title, slug'))
            ->orderByDesc('description_length')
            ->first();

        $this->result[] = [
            'Самая длинная статья:' => $article->title,
            'Ссылка на статью:' => route('articles.show', $article->slug),
            'Длина статьи в символах:' => $article->description_length
        ];
    }

    public function shortestArticle()
    {
        $article = DB::table('articles')
            ->select(DB::raw('LENGTH(description) As description_length, title, slug'))
            ->orderBy('description_length')
            ->first();

        $this->result[] = [
            'Самая короткая статья:' => $article->title,
            'Ссылка на статью:' => route('articles.show', $article->slug),
            'Длина статьи в символах:' => $article->description_length,
        ];
    }

    public function averageNumberOfArticlesByActiveUsers()
    {
        $numberOfArticlesPerUser = 1;

        $articles = DB::select('SELECT COUNT(*) as count
        FROM articles
        GROUP BY owner_id
        HAVING count > ?', [$numberOfArticlesPerUser]);

        $collection = collect(json_decode(json_encode($articles), true));
        $averageNumberOfArticlesByActiveUsers = $collection->flatten()->avg();

        $this->result[] = [
            'Средние количество статей у активных пользователей:' => $averageNumberOfArticlesByActiveUsers,
        ];
    }

    public function mostVolatileArticle()
    {
        $article = ArticleHistory::selectRaw('article_id, count(*) as count_articles')
            ->groupBy('article_id')
            ->orderByDesc('count_articles')
            ->first()
            ->article;

        $this->result[] = [
            'Самая непостоянная:' => $article->title,
            'Ссылка на статью:' => route('articles.show', $article->slug)
        ];
    }

    public function mostDiscussedArticle()
    {
        $articleId = Comment::where('commentable_type', Article::class)
            ->selectRaw('commentable_id, count(*) as count_comments')
            ->groupBy('commentable_id')
            ->orderByDesc('count_comments')
            ->first()
            ->commentable_id;

        $article = Article::find($articleId);

        $this->result[] = [
            'Самая обсуждаемая статья:' => $article->title,
            'Ссылка на статью:' => route('articles.show', $article->slug),
        ];
    }
}
