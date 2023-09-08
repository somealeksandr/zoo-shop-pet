<?php

namespace App\Services\Subscription;

use App\DTO\Subscription\CreateSubscriptionDTO;
use App\Services\Subscription\Handlers\Create;

class SubscriptionService
{
    public function create(CreateSubscriptionDTO $createSubscriptionDTO)
    {
        (new Create($createSubscriptionDTO))->handle();
    }
}
