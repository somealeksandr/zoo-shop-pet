<?php

namespace App\DTO\Profile;

use App\DTO\BaseDTO;
use App\Models\User;

final class UpdatePasswordDTO extends BaseDTO
{
    public User $user;

    public string $new_password;
}
