<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Api\AbstractApiRequest;
use Illuminate\Validation\Rule;

class FiltersProductRequest extends AbstractApiRequest
{
    public function rules(): array
    {
        return [
            'price_min' => [
                'min:1'
            ],
            'price_max' => [
                'min:1'
            ],
            'subcategories' => [
                'array'
            ],
            'subcategories.*' => [
                'exists:subcategories,slug'
            ],
            'brands' => [
                'array'
            ],
            'brands.*' => [
                'exists:brands,slug'
            ],
            'countries' => [
                'array'
            ],
            'countries.*' => [
                'exists:countries,slug'
            ],
            'new' => [
                'bool'
            ],
            'is_promotional' => [
                'bool'
            ],
//            'quantity' => [
//                'sometimes'
//            ],
            'sort' => [
                Rule::in(['cheap', 'expensive', 'new'])
            ]
        ];
    }
}
