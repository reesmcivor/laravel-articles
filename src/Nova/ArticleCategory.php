<?php

namespace ReesMcIvor\Articles\Nova;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Whitecube\NovaFlexibleContent\Flexible;

class ArticleCategory extends Resource
{

    public static $model = \ReesMcIvor\Articles\Models\ArticleCategory::class;
    public static $title = 'name';
    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->required(),
            BelongsTo::make('Parent Category', 'parent', self::class)->nullable(),
            Select::make('Type')
                ->options(['health_and_fitness' => 'Health & Fitness', 'sport_and_activity' => 'Sport & Activity'])
                ->sortable()
                ->rules('max:255')
                ->onlyOnDetail(function () use ($request) {
                    return $request->resource()->classification == 'article';
                })
                ->onlyOnIndex(function () use ($request) {
                    return $request->resource()->classification == 'article';
                })
                ->onlyOnForms(function () use ($request) {
                    return $request->resource()->classification == 'article';
                }),
            Select::make('Classification')->options(['news' => 'News', 'article' => 'Article']),
            Number::make('Sort Order'),
            Boolean::make('Featured'),
            Date::make('Publish From'),
            Date::make('Publish To'),
            Slug::make('Slug')->from('name')->creationRules('unique:article_categories,slug')->onlyOnForms(),
        ];
    }

}
