<?php

namespace App\Services\Subscription\Handlers;

use App\DTO\Subscription\DeleteSubscriptionDTO;
use App\Models\Subscriber;
use App\Services\CaseHandler;

class Delete implements CaseHandler
{
    public function __construct(private DeleteSubscriptionDTO $deleteSubscriptionDTO)
    {
    }

    public function handle(): void
    {
        $user = $this->deleteSubscriptionDTO->user;
        $subscriber = Subscriber::where('email', $user->email)->first();

        $subscriber?->subscriptionAnimals()->detach($this->deleteSubscriptionDTO->animal_id);
    }
}
