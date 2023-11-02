<?php

namespace App\Services\Subscription;

use App\DTO\Subscription\CreateSubscriptionDTO;
use App\DTO\Subscription\DeleteSubscriptionDTO;
use App\Services\Subscription\Handlers\Create;
use App\Services\Subscription\Handlers\Delete;

class SubscriptionService
{
    public function create(CreateSubscriptionDTO $createSubscriptionDTO)
    {
        (new Create($createSubscriptionDTO))->handle();
    }

    public function delete(DeleteSubscriptionDTO $deleteSubscriptionDTO)
    {
        (new Delete($deleteSubscriptionDTO))->handle();
    }
}
