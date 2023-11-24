<?php

namespace ReesMcIvor\Articles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoriesRequest extends FormRequest
{
    public function authorize() : bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'classification' => 'sometimes'
        ];
    }

}
