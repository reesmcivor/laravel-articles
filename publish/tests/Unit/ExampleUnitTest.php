<?php

namespace ReesMcIvor\Articles\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ReesMcIvor\Articles\Models\Article;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_article()
    {
        $article = Article::factory()->create();

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
        ]);
    }
}