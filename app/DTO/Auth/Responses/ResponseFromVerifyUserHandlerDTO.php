<?php

namespace App\DTO\Auth\Responses;

use App\DTO\BaseDTO;
use App\Models\User;

final class ResponseFromVerifyUserHandlerDTO extends BaseDTO
{
    protected User $user;

    protected string $token;
}
