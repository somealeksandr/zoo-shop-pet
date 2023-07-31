<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\AbstractApiRequest;
use Illuminate\Validation\Rule;

class SignUpRequest extends AbstractApiRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:1',
            ],
            'surname' => [
                'required',
                'string',
                'min:1',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'phone_number' => [
                'required',
                'string',
                'min:10',
                'max:13',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
            ],
            'password' => [
                'required',
                'confirmed',
            ],
        ];
    }
}
