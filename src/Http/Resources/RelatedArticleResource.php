<?php

namespace ReesMcIvor\Articles\Http\Resources;

use App\Models\Exercise;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use ReesMcIvor\Articles\Http\Resources\ArticleCategoryResource;

class RelatedArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image ? Storage::disk('articles')->url($this->image) : '',
            'published_at' => $this->published_at?->format('jS M Y'),
            'is_premium' => $this->is_premium,
            'categories' => ArticleCategoryResource::collection($this->categories),
        ];
    }

}
