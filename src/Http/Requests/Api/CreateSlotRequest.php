<?php

namespace ReesMcIvor\SlotKeeper\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateSlotRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'model' => 'required|in:' . implode(",", array_keys(config('slot-keeper.models'))),
            'query' => 'required',
        ];
    }
}
