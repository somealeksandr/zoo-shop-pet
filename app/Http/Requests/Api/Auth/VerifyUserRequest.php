<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\AbstractApiRequest;
use Illuminate\Validation\Rule;

class VerifyUserRequest extends AbstractApiRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                Rule::exists('users', 'email'),
            ],
            'confirmation_code' => [
                'required',
                Rule::exists('users')->where('email', $this->input('email')),
            ],
        ];
    }
}
