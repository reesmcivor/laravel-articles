<?php

Route::middleware(['api', 'auth:sanctum'])->prefix('api')->group(function () {

    Route::get('articles/categories/index', [\ReesMcIvor\Articles\Http\Controllers\Api\ArticleCategoryController::class, 'index']);
    Route::get('articles/categories/featured', [\ReesMcIvor\Articles\Http\Controllers\Api\ArticleCategoryController::class, 'featured']);
    Route::get('articles/index', [\ReesMcIvor\Articles\Http\Controllers\Api\ArticlesController::class, 'index']);
    Route::get('articles/show/{article}', [\ReesMcIvor\Articles\Http\Controllers\Api\ArticlesController::class, 'show']);
    Route::get('articles/categories/{articleCategory}', [\ReesMcIvor\Articles\Http\Controllers\Api\ArticleCategoryController::class, 'show']);
});
