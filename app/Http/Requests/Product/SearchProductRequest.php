<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Api\AbstractApiRequest;
use Illuminate\Validation\Rule;

class SearchProductRequest extends AbstractApiRequest
{
    public function rules(): array
    {
        return [
            'search' => [
                'min:1'
            ],
            'lang' => [
                Rule::in(['ua', 'en'])
            ]
        ];
    }
}
