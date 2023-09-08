<?php

namespace App\Http\Controllers\Api\Subscription;

use App\DTO\Subscription\CreateSubscriptionDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Api\Subscription\CreateSubscriptionRequest;
use App\Services\Subscription\SubscriptionService;

class SubscriptionController extends AbstractApiController
{
    public function __construct(private SubscriptionService $service)
    {
    }

    public function create(CreateSubscriptionRequest $request)
    {
        $this->service->create(CreateSubscriptionDTO::fromArray($request->validated()));
    }
}
