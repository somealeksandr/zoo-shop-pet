<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\AbstractApiRequest;
use App\Rules\Auth\CheckIfPasswordNotOld;

final class UpdatePasswordRequest extends AbstractApiRequest
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
            'new_password' => [
                'required',
                'confirmed',
                'different:password',
                new CheckIfPasswordNotOld($this->user())
            ],
        ];
    }
}
