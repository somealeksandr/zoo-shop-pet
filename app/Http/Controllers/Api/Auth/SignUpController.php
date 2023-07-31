<?php

namespace App\Http\Controllers\Api\Auth;

use App\DTO\Auth\SignUpDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Api\Auth\SignUpRequest;
use App\Http\Requests\Api\Auth\VerifyUserRequest;
use App\Services\Auth\SignUp\SignUpService;
use Illuminate\Http\JsonResponse;

class SignUpController extends AbstractApiController
{
    protected SignUpService $service;

    public function __construct(SignUpService $service)
    {
        $this->service = $service;
    }

    public function signUp(SignUpRequest $request): JsonResponse
    {
        $responseFromSignUpHandler = $this->service->signUp(SignUpDTO::fromArray($request->validated()));

        return $this->success($responseFromSignUpHandler, 'User successfully registered. Verification mail has been sent.');
    }

    public function verifyUser(VerifyUserRequest $request): JsonResponse
    {
        $responseFromVerifyUserHandler = $this->service->verifyUser($request->input('email'), $request->input('confirmation_code'));

        return $this->success($responseFromVerifyUserHandler, 'User email has been successfully verified.');
    }

    public function resendVerifyMail(ResendVerifyMailRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->service->resendVerifyMail($data['email']);

        return $this->success([], 'Verify mail has been sent.');
    }
}
