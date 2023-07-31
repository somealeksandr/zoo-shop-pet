<?php

namespace App\Services\Auth\SignIn\Handlers;

use App\DTO\Auth\Responses\ResponseFromSignInHandlerDTO;
use App\Models\User;
use App\Services\CaseHandler;
use Exception;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

final class SignIn implements CaseHandler
{
    protected string $email;

    protected string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @throws Exception
     */
    public function handle(): ResponseFromSignInHandlerDTO
    {
        $isValidCredentials = Auth::attempt(
            [
                'email'     => $this->email,
                'password'  => $this->password,
            ]
        );

        if ($isValidCredentials) {
            $user = User::where('email', $this->email)->first();
            $token = JWTAuth::fromUser($user);
        } else {
            throw new Exception('Wrong credentials');
        }

        if ($user->two_factor_enabled) {
            $token = null;
        }

        return ResponseFromSignInHandlerDTO::fromArray(compact('token', 'user'));
    }
}
