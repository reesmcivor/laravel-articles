<?php

namespace ReesMcIvor\Articles\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Articles\Models\Article;

class ArticleFactory extends Factory
{

    protected $model = Article::class;

    public function definition() : array
    {
        return [
            'title' => $this->faker->name,
            'slug' => $this->faker->slug,
            'publish_at' => now(),
        ];
    }
}
