<?php

namespace ReesMcIvor\Articles\Traits;

use Illuminate\Database\Eloquent\Relations\MorphByMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use ReesMcIvor\Articles\Models\Article;
use ReesMcIvor\SlotKeeper\Models\SlotKeeper;

trait HasArticles
{
    public function articles() : MorphToMany
    {
        return $this->morphToMany(Article::class, 'articleable');
    }
}