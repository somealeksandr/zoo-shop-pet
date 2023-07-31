<?php

namespace App\Rules\Auth;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

final class PasswordHashCorrect implements Rule
{
    protected ?string $email;

    public function __construct(?string $email)
    {
        $this->email = $email;
    }

    public function passes($attribute, $value): bool
    {
        if (!$this->email) {
            return false;
        }

        $user = User::where('email', $this->email)->first();
        if ($user) {
            return Hash::check($value, $user->password);
        }

        return false;
    }

    public function message()
    {
        return 'Entered password is incorrect. Please check and try again.';
    }
}
