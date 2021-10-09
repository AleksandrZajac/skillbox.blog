<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->words(3, true),
            'title' => $this->faker->words(4, true),
            'description' => $this->faker->words(4, true),
            'short_description' => $this->faker->sentence,
            'owner_id' => User::factory(),
            'is_published' => rand(0, 1),
        ];
    }
}
