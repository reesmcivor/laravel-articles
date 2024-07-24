<?php

namespace ReesMcIvor\Articles\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCategoryTree extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'parent_id' => $this->parent_id,
            'children' => ArticleCategoryTree::collection($this->children),
            'article_count' => $this->articles()->count(),
            'articles' => ArticleResource::collection($this->articles)
        ];
    }
}
