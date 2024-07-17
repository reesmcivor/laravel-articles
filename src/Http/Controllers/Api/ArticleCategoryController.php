<?php

namespace ReesMcIvor\Articles\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Http\Requests\ArticleCategoriesRequest;
use ReesMcIvor\Articles\Http\Resources\ArticleCategoryResource;
use ReesMcIvor\Articles\Models\Article;
use ReesMcIvor\Articles\Http\Resources\ArticleResource;
use ReesMcIvor\Articles\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{

    public function index( ArticleCategoriesRequest $request ) {
        $classification = $request->get('classification') ?? 'article';
        $articleCategories = ArticleCategory
            ::whereNull('parent_id')
            ->withCount(['articles' => function($query) {
                $query->published();
            }])
            ->whereHas('articles', fn($query) => $query->published())
            ->get();

        return response()->json([
            'message' => 'Article Categories',
            'data' => ArticleCategoryResource::collection($articleCategories),
        ]);
    }
    public function listings( ArticleCategoriesRequest $request )
    {
        Log::debug($request->get('classification'));
        $articleCategories = ArticleCategory
            ::where('classification', $request->get('classification') ?? 'article')
            ->withCount(['articles' => function($query) {
                $query->published();
            }])
            ->whereHas('articles', fn($query) => $query->published())->get();

        return response()->json([
            'message' => 'Article Categories',
            'data' => ArticleCategoryResource::collection($articleCategories),
        ]);
    }

    public function featured( ArticleCategoriesRequest $request)
    {
        return response()->json([
            'message' => 'Published featured categores',
            'data' => ArticleCategoryResource::collection( ArticleCategory::published()->featured()->get() )
        ]);
    }

    public function show( Request $request, ArticleCategory $articleCategory )
    {
        $userLabels = $request->user()->labels;
        $labelNamesWithDescendants = $userLabels->flatMap(function ($label) {
            return collect([$label->name])->merge($label?->all_descendants?->pluck('name') ?? []);
        })->unique()->filter()->toArray();

        // First, try to get articles that match the user's labels
        $articles = $articleCategory->articles()->published()
            ->whereHas('labels', function ($query) use ($userLabels, $labelNamesWithDescendants) {
                $query->whereIn('name', $labelNamesWithDescendants);
            })
            ->get();

        Log::debug('Found: ' . $articles->count() . ' articles');


        // If no articles are found, fetch all articles
        if ($articles->isEmpty()) {
            $articles = $articleCategory->articles()->published()->get();
        }

        return response()->json([
            'message' => 'Article Categories',
            'data' => ArticleResource::collection($articles),
        ]);
    }

}
