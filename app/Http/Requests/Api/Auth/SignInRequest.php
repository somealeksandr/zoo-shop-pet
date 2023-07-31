<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\AbstractApiRequest;
use App\Rules\Auth\PasswordHashCorrect;
use Illuminate\Validation\Rule;

class SignInRequest extends AbstractApiRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::exists('users')->whereNotNull('email_verified_at'),
            ],
            'password' => [
                'required',
                new PasswordHashCorrect($this->input('email')),
            ],
        ];
    }
}
