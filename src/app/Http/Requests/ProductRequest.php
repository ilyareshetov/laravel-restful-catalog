<?php

namespace App\Http\Requests;


class ProductRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'published' => 'required|boolean',
            'categories' => 'required|array|min:2|max:10|exists:categories,id',
        ];
    }
}
