<?php

namespace ReesMcIvor\Articles\Nova;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Article extends Resource
{

    public static $model = \ReesMcIvor\Articles\Models\Article::class;
    public static $title = 'id';
    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->required(),
            Slug::make('Slug')->from('Title')->required(),
            //Text::make('Slug'),
            //Textarea::make('Summary'),
            Select::make('Status', 'status')->options([
                'published' => 'Published',
                'draft' => 'Draft',
                'private' => 'Private',
            ])->displayUsingLabels()->required(),
            Flexible::make('Content')->fullWidth()
                ->addLayout('Simple content section', 'wysiwyg', [
                    Text::make('Title'),
                    Markdown::make('Content')
                ])
                ->addLayout('Two Column Section', 'two_column', [
                    Text::make('Title'),
                    Markdown::make('Left Column'),
                    Markdown::make('Right Column')
                ])
                ->addLayout('Image', 'image', [
                    Image::make('Image')->path('/images')
                        ->preview(function ($value, $disk) {
                            if ($value) {
                                $url = Storage::disk("articles")->url($value);
                                return $url ?? null;
                            } else {
                                return null;
                            }
                        })->thumbnail(function ($value, $disk) {
                            if ($value) {
                                $url = Storage::disk("articles")->url("test" . $value);
                                return $url ?? null;
                            } else {
                                return null;
                            }
                        })->disk('articles'),
                ])
                ->addLayout('Related Routine', 'related_routine', [
                    Select::make('Routine')->options(\App\Models\Routine::all()->pluck('name', 'id')->toArray())
                ])
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
