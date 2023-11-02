<?php

namespace App\Http\Controllers\Api\Subscription;

use App\DTO\Subscription\CreateSubscriptionDTO;
use App\DTO\Subscription\DeleteSubscriptionDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Api\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\Api\Subscription\DeleteSubscriptionRequest;
use App\Services\Subscription\SubscriptionService;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends AbstractApiController
{
    public function __construct(private SubscriptionService $service)
    {
    }

    public function create(CreateSubscriptionRequest $request): JsonResponse
    {
        $this->service->create(CreateSubscriptionDTO::fromArray($request->validated()));

        return $this->success([], 'Subscription created success!');
    }

    public function delete(DeleteSubscriptionRequest $request): JsonResponse
    {
        $this->service->delete(DeleteSubscriptionDTO::fromArray($request->validated()));

        return $this->success([], 'Subscription deleted success!');
    }
}
