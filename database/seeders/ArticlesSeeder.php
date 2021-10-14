<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::factory()
            ->count(20)
            ->state(new Sequence(function ($sequence) {
                return ['owner_id' => User::all()->random()];
            }))
            ->create();
    }
}
