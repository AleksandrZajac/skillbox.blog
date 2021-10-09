<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Tag;

class TagsArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::all();

        $tagsArticles = $articles
            ->each( function (Article $articles) {
                $articles->tags()->saveMany(Tag::all()->random(2));
        });
    }
}
