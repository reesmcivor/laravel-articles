<?php

namespace ReesMcIvor\Articles\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Models\Article;

class ArticlesController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'List of Articles',
            'data' => Article::query()->select(['id', 'title', 'slug', 'image', 'created_at'])
                ->get()
                ->map(function ($article) {
                    return [
                        'id' => $article->id,
                        'title' => $article->title,
                        'slug' => $article->slug,
                        'image' => Storage::disk('articles')->url($article->image),
                        'created_at' => $article->created_at->format('jS M Y'),
                    ];
                })
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
                'image' => Storage::disk('articles')->url($article->image),
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
