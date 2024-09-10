<?php

namespace ReesMcIvor\Articles\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Articles\Database\Factories\ArticleCategoryFactory;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'classification'];
    public static $orderBy = ['sort_order' => 'asc'];

    public $dates = [
        'publish_from',
        'publish_to'
    ];

    protected static function newFactory()
    {
        return new ArticleCategoryFactory();
    }

    protected static function boot() {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            //$builder->orderBy('sort_order', 'asc');
            //$builder->orderByRaw('sort_order * 1 ASC');
        });
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->where('featured', 1)->orderBy('publish_from', 'asc');
    }

    public function scopePublished(Builder $query)
    {
        // If the publish_at has been set then do where publish_at >= current date
        return $query->where(function ($query) {
            $query->whereNull('publish_from')->orWhere('publish_from', '<=', now());
        })
        ->where(function ($query) {
            $query->whereNull('publish_to')->orWhere('publish_to', '>=', now());
        });
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category');
    }

    public function children()
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ArticleCategory::class, 'parent_id');
    }
}
