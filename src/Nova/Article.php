<?php

namespace ReesMcIvor\Articles\Nova;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\ManyToManyCreationRules;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Hidden;
use App\Models\Exercise;
use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Article extends Resource
{

    public static $model = \ReesMcIvor\Articles\Models\Article::class;
    public static $title = 'title';
    public static $search = [
        'id', 'title'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->required(),
            Slug::make('Slug')->from('Title')->required(),
            Boolean::make('Is Premium', 'is_premium')
                ->displayUsing(function ($value) {
                    return $value ? 'Yes' : 'No';
                })
                ->resolveUsing(function ($value) {
                    return $value ? true : false;
                }),
            BelongsTo::make('Author', 'author', \ReesMcIvor\Staff\Nova\Staff::class)
                ->searchable()->nullable(),

            DateTime::make('Published At'),
            BelongsToMany::make('Categories', 'categories', ArticleCategory::class)->display('name')->sortable(),
            BelongsToMany::make('Related Articles', 'relatedArticles', Article::class)
                ->sortable()
                ->searchable(),
            BelongsToMany::make('Routines', 'routines', Routine::class)->display('name')
                ->sortable()
                ->searchable(),
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
                        $url = Storage::disk("articles")->url($value);
                        return $url ?? null;
                    } else {
                        return null;
                    }
                })->disk('articles'),
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
                ->addLayout('Video', 'video', [
                    Select::make('Video')->searchable()->options(
                        Exercise::all()->pluck('name', 'id')->toArray()
                    )->displayUsingLabels(),
                ])
                ->addLayout('Audio', 'audio', [
                    File::make('Audio')->disk('articles'),
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
                ->addLayout('Related Routines', 'related_routines', [
                    Hidden::make("Premium Breakpoint", "premium_breakpoint"),
                ])
                ->addLayout('Premium Breakpoint', 'premium_breakpoint', [
                    Hidden::make("Premium Breakpoint", "premium_breakpoint"),
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
    public function filters(Request $request)
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
