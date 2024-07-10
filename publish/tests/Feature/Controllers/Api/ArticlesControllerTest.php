<?php

namespace ReesMcIvor\Articles\Tests\Feature\Controllers\Api;

use App\Models\User;
use ReesMcIvor\Articles\Models\ArticleCategory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ReesMcIvor\Articles\Models\Article;

class ArticlesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_articles()
    {
        Article::factory()->create();
        $this
            ->actingAs(User::factory()->create())
            ->getJson('api/articles/index')
            ->assertJsonStructure([
                'message',
                'data' => [[
                    'id', 'image'
                ]],
                'has_more_pages',
                'page'
            ]);
    }

    /** @test */
    public function get_featured_categories()
    {

        $articleCategory = ArticleCategory::factory()->create([
            'name' => 'Posture',
            'slug' => 'posture',
            'featured' => 1
        ]);

        $article = Article::factory()->create();
        $article->categories()->sync($articleCategory->id);

        $this
            ->actingAs(User::factory()->create())
            ->getJson('api/articles/categories/featured')
            ->assertJson([
                'message' => 'Published featured categores',
                'data' => [
                    [
                        'id' => 1,
                        'name' => 'Posture',
                        'article_count' => 1
                    ]
                ]
            ]);
    }
}
