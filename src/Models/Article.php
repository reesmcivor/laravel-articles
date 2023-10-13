<?php

namespace ReesMcIvor\Articles\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Articles\Database\Factories\ArticleFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [
        'content' => 'array'
    ];

    protected static function newFactory()
    {
        return new ArticleFactory();
    }

    public function parent()
    {
        return $this->belongsTo(Article::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Article::class, 'parent_id');
    }
}
