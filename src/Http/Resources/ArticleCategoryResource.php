<?php

namespace ReesMcIvor\Articles\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'article_count' => $this->articles()->count(),
            'parent_id' => $this->parent_id,
            'children' => ArticleCategoryResource::collection($this->children)
        ];
    }
}
