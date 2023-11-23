<?php

namespace ReesMcIvor\Articles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Articles\Database\Factories\ArticleCategoryFactory;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'classification'];

    protected static function newFactory()
    {
        return new ArticleCategoryFactory();
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category');
    }
}