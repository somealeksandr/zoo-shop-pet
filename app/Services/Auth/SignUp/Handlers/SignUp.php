<?php

namespace App\Services\Auth\SignUp\Handlers;

use App\DTO\Auth\Responses\ResponseFromSignUpHandlerDTO;
use App\DTO\Auth\SignUpDTO;
use App\Mail\Auth\CreateNewUserMail;
use App\Models\User;
use App\Services\CaseHandler;
use Illuminate\Support\Facades\Mail;

final class SignUp implements CaseHandler
{
    protected SignUpDTO $signUpDTO;

    private ?User $user;

    public function __construct(SignUpDTO $signUpDTO)
    {
        $this->signUpDTO = $signUpDTO;
    }

    public function handle(): ResponseFromSignUpHandlerDTO
    {
        $this->user = User::where('email', $this->signUpDTO->email)->first();

        if (!$this->user) {
            $this->createNewUser();
        }

        // todo uncomment after setup mail sender
//        Mail::to($this->user->email)->send(new CreateNewUserMail($this->user->confirmation_code));
        $code = $this->user->confirmation_code;

        return ResponseFromSignUpHandlerDTO::fromArray(compact('code'));
    }

    private function createNewUser()
    {
        $data = $this->signUpDTO->toArray();
        $data['password'] = bcrypt($data['password']);
        $this->user = User::create($data);
    }
}
