<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Api\Auth\SignInRequest;
use App\Services\Auth\SignIn\SignInService;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class SignInController
 * @package App\Modules\Auth\Http\Controllers
 */
class SignInController extends AbstractApiController
{
    protected SignInService $service;

    public function __construct(SignInService $service)
    {
        $this->service = $service;
    }

    public function signIn(SignInRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $responseFromSignInHandler = $this->service->signIn($credentials['email'], $credentials['password']);

        return $this->success($responseFromSignInHandler, 'User successfully authenticated.');
    }

    public function signOut(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->success([], 'You have successfully logged out.');
    }
}
