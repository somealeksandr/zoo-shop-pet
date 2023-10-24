<?php

namespace App\Http\Controllers\Api\Profile;

use App\DTO\Profile\UpdatePasswordDTO;
use App\DTO\Profile\UpdateProfileDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Api\Profile\GetMeRequest;
use App\Http\Requests\Api\Profile\UpdatePasswordRequest;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use App\Services\Profile\ProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController extends AbstractApiController
{
    public function __construct(private ProfileService $service)
    {
    }

    public function me(GetMeRequest $request): JsonResponse
    {
        $user = $request->user();

        return $this->success(compact('user'), 'Me.');
    }

    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $this->service->update(UpdateProfileDTO::fromArray($request->validated()));

        return $this->success(compact('user'), 'Successful update profile!');
    }

    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $this->service->updatePassword(UpdatePasswordDTO::fromArray($request->validated()));

        return $this->success([], 'Password successful update!');
    }

    public function storeFavorite()
    {
        
    }
}
