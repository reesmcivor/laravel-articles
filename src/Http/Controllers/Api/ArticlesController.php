<?php

namespace ReesMcIvor\Articles\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Models\Article;
use ReesMcIvor\Articles\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function index( Request $request)
    {

        $categoryId = $request->get('category');
        $articles = Article::published()
            ->orderBy('published_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->with('categories')
            ->when($categoryId && $categoryId != 0, function($query) use ($categoryId) {
                return $query->whereHas('categories', function ($subQuery) use ($categoryId) {
                    $subQuery->where('article_categories.id', $categoryId);
                });
            })
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
