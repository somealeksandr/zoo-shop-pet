<?php

namespace App\Http\Requests\Api\Subscription;

use App\Http\Requests\Api\AbstractApiRequest;
use Illuminate\Validation\Rule;

class DeleteSubscriptionRequest extends AbstractApiRequest
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
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'user' => [
                'required',
            ],
            'animal_id' => [
                'required',
                Rule::exists('animals', 'id')
            ],
        ];
    }
}
