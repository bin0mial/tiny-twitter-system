<?php

namespace App\Http\Requests\Api\V1\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class StoreTweetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "tweet" => ["required", "string", "max:140"]
        ];
    }
}
