<?php

namespace App\Http\Requests\Api\News;

use App\Http\Requests\Api\AbstractApiRequest;

class NewsRequest extends AbstractApiRequest
{
    public function rules(): array
    {
        return [
            'amount' => [
                'sometimes',
                'numeric',
            ],
            'per_page' => [
                'sometimes',
                'numeric',
            ]
        ];
    }
}
