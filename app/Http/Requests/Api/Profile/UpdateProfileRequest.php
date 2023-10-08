<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\AbstractApiRequest;
use Illuminate\Validation\Rule;

final class UpdateProfileRequest extends AbstractApiRequest
{
    public function authorize(): bool
    {
        if ($this->user()) {
            $this->merge([
                'user' => $this->user(),
            ]);

            return true;
        }

        return false;
    }

    public function rules(): array
    {
        return [
            'user' => [
                'required',
            ],
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
                Rule::unique('users', 'email')->ignoreModel($this->user()),
            ],
            'phone_number' => [
                'required',
                'string',
                'min:10',
                'max:13',
                Rule::unique('users', 'phone_number')->ignoreModel($this->user()),
                'regex:/^([0-9\s\-\+\(\)]*)$/',
            ],
        ];
    }
}
