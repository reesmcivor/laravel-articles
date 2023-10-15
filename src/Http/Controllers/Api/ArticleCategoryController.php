<?php

namespace ReesMcIvor\Articles\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Models\Article;
use ReesMcIvor\Articles\Http\Resources\ArticleResource;
use ReesMcIvor\Articles\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $articles = ArticleCategory::published()->with('categories')->get();

        return response()->json([
            'message' => 'List of Articles',
            'data' => ArticleResource::collection($articles),
        ]);
    }

    public function show(Article $article)
    {

        return response()->json([
            'message' => 'Article',
            'article' => [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'image' => $article->image ? Storage::disk('articles')->url($article->image) : '',
                'content' => collect($article->content)->map(function ($section) {
                    if($section['layout'] === 'image') {
                        $section['attributes']['image'] = Storage::disk('articles')->url($section['attributes']['image']);
                    }
                    return $section;
                }),
                'created_at' => $article->created_at->format('jS M Y'),
            ]
        ]);
    }
}
