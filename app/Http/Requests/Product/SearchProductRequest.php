<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Api\AbstractApiRequest;

class SearchProductRequest extends AbstractApiRequest
{
    public function rules(): array
    {
        return [
            'search' => [
                'min:1'
            ],
        ];
    }
}
