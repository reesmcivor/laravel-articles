<?php

namespace ReesMcIvor\Articles\Http\Resources;

use App\Http\Resources\RoutineResource;
use App\Models\Exercise;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Http\Resources\ArticleCategoryResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'classification' => $this->classification,
            'author' => $this->author?->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image ? Storage::disk('articles')->url($this->image) : '',
            'published_at' => $this->published_at?->format('jS M Y'),
            'is_premium' => $this->is_premium,
            'categories' => ArticleCategoryResource::collection($this->categories),
            'related_articles' => RelatedArticleResource::collection($this->relatedArticles),
            'routines' => RoutineResource::collection($this->routines),
            'content' => collect($this->content)->map(function($content) {
                switch($content['layout']) {
                    case "image":
                    case "audio":
                        $content['attributes'][$content['layout']] = Storage::disk('articles')->url($content['attributes'][$content['layout']]);
                    break;
                    case "video":
                        $content['attributes']['video'] = Exercise::find($content['attributes']['video']);
                    break;
                }
                return $content;
            }),
            'media_type' => $this->media_type,
        ];
    }

}
