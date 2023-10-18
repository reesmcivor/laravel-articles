<?php

namespace ReesMcIvor\Articles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Articles\Database\Factories\ArticleFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

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

    public function scopePublished($query)
    {
        return $query->where(function ($query) {
            $query->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        });
    }
}
