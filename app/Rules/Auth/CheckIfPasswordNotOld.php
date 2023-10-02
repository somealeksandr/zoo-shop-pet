<?php

namespace App\Rules\Auth;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

final class CheckIfPasswordNotOld implements Rule
{
    public function __construct(private User $user)
    {
    }

    public function passes($attribute, $value): bool
    {
        return !Hash::check($value, $this->user->password);
    }

    public function message(): string
    {
        return 'Password does not match';
    }
}
