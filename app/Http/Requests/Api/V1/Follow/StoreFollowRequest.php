<?php

namespace App\Http\Requests\Api\V1\Follow;

use Illuminate\Foundation\Http\FormRequest;

class StoreFollowRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id" => ["required", "exists:users", "not_in:".$this->user()->id]
        ];
    }
}
