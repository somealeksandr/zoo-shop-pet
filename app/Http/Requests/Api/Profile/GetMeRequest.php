<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\AbstractApiRequest;

final class GetMeRequest extends AbstractApiRequest
{
    public function authorize(): bool
    {
        if ($this->user()) {
            $this->merge([
                'user' => $this->user()->getKey(),
            ]);

            return true;
        }

        return false;
    }

    public function rules(): array
    {
        return [];
    }
}
