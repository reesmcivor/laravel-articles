<?php

namespace ReesMcIvor\Articles\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Http\Requests\ArticlesRequest;
use ReesMcIvor\Articles\Models\Article;
use ReesMcIvor\Articles\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function index( ArticlesRequest $request)
    {
        $categoryId = $request->get('category');
        $articles = Article::published()
            ->where('classification', $request->get('classification') ?? 'article')
            ->paginate(9999);

        return response()->json([
            'message' => 'List of Articles',
            'data' => ArticleResource::collection($articles),
            'has_more_pages' => $articles->hasMorePages(),
            'page' => $request->get('page')
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
