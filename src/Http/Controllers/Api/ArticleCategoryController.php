<?php

namespace ReesMcIvor\Articles\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Http\Resources\ArticleCategoryResource;
use ReesMcIvor\Articles\Models\Article;
use ReesMcIvor\Articles\Http\Resources\ArticleResource;
use ReesMcIvor\Articles\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $articleCategories = ArticleCategory
            ::withCount(['articles' => function($query) {
                $query->published();
            }])
            ->whereHas('articles', fn($query) => $query->published())->get();
        
        return response()->json([
            'message' => 'Non Empty Article Categories',
            'data' => ArticleCategoryResource::collection($articleCategories),
        ]);
    }

}
