<?php

namespace ReesMcIvor\Articles\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Articles\Models\Article;
use ReesMcIvor\Articles\Models\ArticleCategory;

class ArticleCategoryFactory extends Factory
{

    protected $model = ArticleCategory::class;

    public function definition() : array
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
        ];
    }
}
