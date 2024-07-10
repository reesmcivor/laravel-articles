<?php

namespace ReesMcIvor\Articles\Tests\Unit;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Models\ArticleCategory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ReesMcIvor\Articles\Models\Article;
use Rolandstarke\Thumbnail\Facades\Thumbnail;

class ArticleCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_article_category_can_be_featured()
    {
        $articleCategory = ArticleCategory::factory()->create();
        $articleCategory->featured = true;
        $articleCategory->save();

        $this->assertTrue($articleCategory->featured);

        $this->assertCount(1, ArticleCategory::featured()->get());
    }

    /** @test */
    public function get_article_categories_excluding_featured()
    {
        ArticleCategory::factory()->create([
            'name' => 'Published',
            'slug' => 'published',
            'publish_from' => now()->setDate(2024, 7, 9),
            'publish_to' => now()->setDate(2024, 7, 15)
        ]);

        $this->travelTo(now()->setDate(2024,7,9));
        $this->assertCount(1, ArticleCategory::published()->get());

        $this->travelTo(now()->setDate(2024, 7, 16));
        $this->assertCount(0, ArticleCategory::published()->get());
    }
}
