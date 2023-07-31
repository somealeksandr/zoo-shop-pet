<?php

namespace App\DTO\Auth\Responses;

use App\DTO\BaseDTO;
use App\Models\User;

final class ResponseFromSignInHandlerDTO extends BaseDTO
{
    protected ?string $token;
    protected ?User $user;

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }
}
