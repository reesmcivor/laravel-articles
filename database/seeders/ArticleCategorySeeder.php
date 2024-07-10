<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use ReesMcIvor\Articles\Models\ArticleCategory;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleCategory::factory()->create([
            'classification' => 'article',
            'name' => 'Posture',
            'slug' => 'posture',
            'sort_order' => '1',
            'featured' => 1,
            'publish_from' => now()->setDate(2024, 7, 9),
            'publish_to' => now()->setDate(2024, 7, 15)
        ]);

        ArticleCategory::factory()->create([
            'classification' => 'article',
            'name' => 'Motivation',
            'slug' => 'motivation',
            'sort_order' => '2',
            'featured' => 1,
            'publish_from' => now()->setDate(2024, 7, 15),
            'publish_to' => now()->setDate(2024, 7, 22)
        ]);

        ArticleCategory::factory()->create([
            'classification' => 'article',
            'name' => 'Aging',
            'slug' => 'aging',
            'sort_order' => '3',
            'featured' => 1,
            'publish_from' => now()->setDate(2024, 7, 22),
            'publish_to' => now()->setDate(2024, 7, 29)
        ]);

        ArticleCategory::factory()->create([
            'classification' => 'article',
            'name' => 'Hydration',
            'slug' => 'hydration',
            'sort_order' => '4',
            'featured' => 1,
            'publish_from' => now()->setDate(2024, 7, 29),
            'publish_to' => now()->setDate(2024, 8, 5)
        ]);


    }
}
