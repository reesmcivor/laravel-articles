<?php

namespace ReesMcIvor\Articles;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;
use ReesMcIvor\Articles\Nova\Articles;

class ArticlesPackageServiceProvider extends ServiceProvider
{
    protected $namespace = 'ReesMcIvor\Articles\Http\Controllers';

    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => class_exists('Stancl\Tenancy\TenancyServiceProvider') ? database_path('migrations/tenant') : database_path('migrations'),
                __DIR__ . '/../publish/tests' => base_path('tests/Articles'),
            ], 'laravel-articleables');
        }

        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-articleables');

        Blade::componentNamespace('ReesMcIvor\\Articles\\View\\Components', 'articles');

        Nova::resources([
            Articles::class,
        ]);
    }

    private function modulePath($path)
    {
        return __DIR__ . '/../../' . $path;
    }
}
