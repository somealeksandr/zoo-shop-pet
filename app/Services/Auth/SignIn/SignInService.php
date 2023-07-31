<?php

namespace App\Services\Auth\SignIn;

use App\DTO\Auth\Responses\ResponseFromSignInHandlerDTO;
use App\Services\Auth\SignIn\Handlers\SignIn;

class SignInService
{
    /**
     * @throws \Exception
     */
    public function signIn($email, $password): ResponseFromSignInHandlerDTO
    {
        return (new SignIn($email, $password))->handle();
    }
}
