<?php

namespace ReesMcIvor\Articles\View\Components;

use Illuminate\View\Component;
use ReesMcIvor\Articles\Models\Article;

class ArticleTreeDropdown extends Component
{
    public $articles;
    public $selectOptions;

    public function __construct()
    {
        $this->articles = Article::all();
        $this->selectOptions = $this->generateSelectOptions($this->articles);
    }

    public function generateSelectOptions($articles, $parentId = null, $prefix = '') {
        $options = '';

        foreach ($articles as $article) {
            if ($article->parent_id == $parentId) {
                $options .= '<option value="' . $article->id . '">' . $prefix . $article->name . '</option>';
                $options .= $this->generateSelectOptions($articles, $article->id, $prefix . '-');
            }
        }

        return $options;
    }

    public function render()
    {
        return view('laravel-articleables::components.article-tree-dropdown');
    }
}