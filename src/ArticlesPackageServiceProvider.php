<?php

namespace ReesMcIvor\Articles;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;
use ReesMcIvor\Articles\Nova\Article;
use ReesMcIvor\Articles\Nova\ArticleCategory;
use ReesMcIvor\Articles\Nova\Routine;

class ArticlesPackageServiceProvider extends ServiceProvider
{
    protected $namespace = 'ReesMcIvor\Articles\Http\Controllers';

    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => class_exists('Stancl\Tenancy\TenancyServiceProvider') ? database_path('migrations/tenant') : database_path('migrations'),
                __DIR__ . '/../publish/tests' => base_path('tests/Articles'),
            ], 'laravel-articles');
        }

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-articles');

        Blade::componentNamespace('ReesMcIvor\\Articles\\View\\Components', 'articles');

        Nova::resources([
            Article::class,
            ArticleCategory::class,
            Routine::class
        ]);
    }

    private function modulePath($path)
    {
        return __DIR__ . '/../../' . $path;
    }
}
