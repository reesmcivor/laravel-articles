<?php

Route::middleware('api')->prefix('api')->group(function () {
    Route::get('articles/index', [\ReesMcIvor\Articles\Http\Controllers\Api\ArticlesController::class, 'index']);
    Route::get('articles/show/{article}', [\ReesMcIvor\Articles\Http\Controllers\Api\ArticlesController::class, 'show']);
});
