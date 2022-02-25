<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Tag;

class TagsNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = News::all();

        $tagsNews = $news
            ->each( function (News $news) {
                $news->tags()->saveMany(Tag::all()->random(2));
            });
    }
}
