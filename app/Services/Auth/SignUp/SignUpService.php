<?php


namespace App\Services\Auth\SignUp;

use App\DTO\Auth\Responses\ResponseFromSignUpHandlerDTO;
use App\DTO\Auth\Responses\ResponseFromVerifyUserHandlerDTO;
use App\DTO\Auth\SignUpDTO;
use App\Services\Auth\SignUp\Handlers\SignUp;
use App\Services\Auth\SignUp\Handlers\VerifyUser;

class SignUpService
{
    public function signUp(SignUpDTO $signUpDTO): ResponseFromSignUpHandlerDTO
    {
        return (new SignUp($signUpDTO))->handle();
    }

    public function verifyUser(string $email, string $confirmationCode): ResponseFromVerifyUserHandlerDTO
    {
        return (new VerifyUser($email, $confirmationCode))->handle();
    }
}
