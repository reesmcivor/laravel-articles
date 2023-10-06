<?php

namespace ReesMcIvor\Articles\Services;

use Illuminate\Support\Collection;
use ReesMcIvor\Articles\Models\Article;

class ArticleService {

    public function generateSelectOptions($articles, $parentId = null, $prefix = '')
    {
        $options = '';
        foreach ($articles as $article) {
            if ($article->parent_id == $parentId) {
                $options .= '<option value="' . $article->id . '">' . $prefix . $article->name . '</option>';
                $options .= $this->generateSelectOptions($articles, $article->id, $prefix . '-');
            }
        }
        return $options;
    }

    public function getAllArticles() : Collection
    {
        return Article::all();
    }
}