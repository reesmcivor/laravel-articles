<?php

namespace ReesMcIvor\Articles\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Http\Resources\ArticleCategoryResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image ? Storage::disk('articles')->url($this->image) : '',
            'published_at' => $this->published_at?->format('jS M Y'),
            'is_premium' => $this->is_premium,
            'categories' => ArticleCategoryResource::collection($this->categories),
            'content' => collect($this->content)->map(function($content) {
                switch($content['layout']) {
                    case "image":
                        $content['attributes']['image'] = Storage::disk('articles')->url($content['attributes']['image']);
                    default:
                        return $content;
                }
            }),
        ];
    }

}
