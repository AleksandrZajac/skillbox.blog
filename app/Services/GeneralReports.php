<?php

namespace App\Services;

use App\Models\Article;
use App\Models\News;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;

class GeneralReports
{
    public $data = [];

    public function getData()
    {
        $this->data['report_news'] = $this->getNewsCount();
        $this->data['report_articles'] = $this->getArticlesCount();
        $this->data['report_comments'] = $this->getCommentsCount();
        $this->data['report_tags'] = $this->getTagsCount();
        $this->data['report_users'] = $this->getUsersCount();

        return $this->data;
    }

    public function getNewsCount()
    {
        $totalNews = News::count();

        return request('report_news') ? $totalNews : null;
    }

    public function getArticlesCount()
    {
        $totalArticles = Article::count();

        return request('report_articles') ? $totalArticles : null;
    }

    public function getCommentsCount()
    {
        $totalComments = Comment::count();

        return request('report_comments') ? $totalComments : null;
    }

    public function getTagsCount()
    {
        $totalTags = Tag::count();

        return request('report_tags') ? $totalTags : null;
    }

    public function getUsersCount()
    {
        $totalUsers = User::count();

        return request('report_users') ? $totalUsers : null;
    }
}
