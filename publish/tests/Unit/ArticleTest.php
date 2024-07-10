<?php

namespace ReesMcIvor\Articles\Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ReesMcIvor\Articles\Models\Article;
use Rolandstarke\Thumbnail\Facades\Thumbnail;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_article_has_a_thumbnail()
    {
        $article = Article::factory()->create();

        dd(Storage::disk('thumbnails')->url($article->thumbnail));

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
        ]);
    }
}
