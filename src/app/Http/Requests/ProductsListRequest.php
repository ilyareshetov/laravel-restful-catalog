<?php

namespace App\Http\Requests;

class ProductsListRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|max:255',
            'category_id' => 'integer|exists:categories,id',
            'category' => 'string',
            'price_from' => 'numeric',
            'price_to' => 'numeric',
            'published' => 'boolean',
            'deleted' => 'boolean',
        ];
    }

    public function getFilter(): array
    {
        $filter = [];

        if ($this->title !== null) {
            $filter[] = ['title', 'like', '%' . $this->title . '%'];
        }

        if ($this->price_from !== null) {
            $filter[] = ['price', '>=', $this->price_from];
        }

        if ($this->price_to !== null) {
            $filter[] = ['price', '<=', $this->price_to];
        }

        if ($this->published !== null) {
            $filter[] = ['published', '=', $this->published];
        }

        return $filter;
    }
}
