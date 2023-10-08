<?php

namespace App\DTO\Profile;

use App\DTO\BaseDTO;
use App\Models\User;

final class UpdateProfileDTO extends BaseDTO
{
    public User $user;

    public string $name;

    public string $surname;

    public string $email;

    public string $phone_number;

    public function getUpdateData(): array
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
        ];
    }
}
