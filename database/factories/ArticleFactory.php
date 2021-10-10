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
            'slug' => $this->faker->sentence(rand(1, 3), true),
            'title' => $this->faker->sentence(rand(1, 3), true),
            'description' => $this->faker->realText(rand(100, 400)),
            'short_description' => $this->faker->text(rand(20, 30)),
            'owner_id' => User::factory(),
            'is_published' => rand(0, 1),
        ];
    }
}
