<?php

namespace App\Http\Requests\Api\Subscription;

use App\Http\Requests\Api\AbstractApiRequest;
use Illuminate\Validation\Rule;

class CreateSubscriptionRequest extends AbstractApiRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'animal_id' => [
                'required',
                'array',
            ],
            'animal_id.*' => [
                'required',
                Rule::exists('animals', 'id')
            ],
        ];
    }
}
