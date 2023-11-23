<?php

namespace ReesMcIvor\Articles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesRequest extends FormRequest
{
    public function authorize() : bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'classification' => 'in:news,article'
        ];
    }

}
