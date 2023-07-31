<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Api\Profile\GetMeRequest;
use Illuminate\Http\JsonResponse;

class ProfileController extends AbstractApiController
{
    public function me(GetMeRequest $request): JsonResponse
    {
        $user = $request->user();

        return $this->success(compact('user'), 'Me.');
    }
}
