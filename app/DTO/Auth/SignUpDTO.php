<?php

namespace App\DTO\Auth;

use App\DTO\BaseDTO;

final class SignUpDTO extends BaseDTO
{
    public string $name;

    public string $surname;

    public string $email;

    public string $phone_number;

    public string $password;
}
