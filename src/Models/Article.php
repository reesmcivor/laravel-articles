<?php

namespace ReesMcIvor\Articles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Articles\Database\Factories\ArticleFactory;
use ReesMcIvor\Labels\Traits\HasLabels;

class Article extends Model
{
    use HasFactory;
    use HasLabels;

    protected $fillable = ['name', 'classification'];

    protected $dates = ['published_at'];

    protected $casts = [
        'content' => 'array'
    ];

    protected static function newFactory()
    {
        return new ArticleFactory();
    }

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_category');
    }

    public function author()
    {
        return $this->belongsTo(\App\Models\User::class, 'author_id')->staff();
    }

    public function relatedArticles()
    {
        return $this->belongsToMany(Article::class, 'related_articles', 'article_id', 'related_article_id');
    }

    public function routines()
    {
        return $this->belongsToMany(\App\Models\Routine::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }
}
