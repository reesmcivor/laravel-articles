<?php

namespace ReesMcIvor\Articles\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Models\Article;
use ReesMcIvor\Articles\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::published()->with('categories')->get();

        return response()->json([
            'message' => 'List of Articles',
            'data' => ArticleResource::collection($articles),
        ]);
    }

    public function show(Article $article)
    {

        return response()->json([
            'message' => 'Article',
            'data' => new ArticleResource($article)
        ]);
    }
}
