<?php

namespace App\Services\Auth\SignUp\Handlers;

use App\DTO\Auth\Responses\ResponseFromVerifyUserHandlerDTO;
use App\Models\User;
use App\Services\CaseHandler;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

final class VerifyUser implements CaseHandler
{
    protected string $email;

    protected string $confirmationCode;

    public function __construct(string $email, string $confirmationCode)
    {
        $this->email = $email;
        $this->confirmationCode = $confirmationCode;
    }

    public function handle(): ResponseFromVerifyUserHandlerDTO
    {
        return DB::transaction(function () {
            $user = User::where('email', $this->email)->where('confirmation_code', $this->confirmationCode)->first();

            $user->email_verified_at = Carbon::now();
            $user->update();

            $token = JWTAuth::fromUser($user);

            return ResponseFromVerifyUserHandlerDTO::fromArray(compact('user', 'token'));
        });
    }
}
