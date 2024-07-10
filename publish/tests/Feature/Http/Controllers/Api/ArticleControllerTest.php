<?php

namespace ReesMcIvor\Articles\Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;
use ReesMcIvor\Articles\Models\Article;

class ArticleControllerTest extends TestCase
{

    /** @test */
    public function it_can_create_a_article()
    {
        $article = Article::factory()->create();

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
        ]);
    }
}