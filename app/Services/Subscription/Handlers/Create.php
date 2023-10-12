<?php

namespace App\Services\Subscription\Handlers;

use App\DTO\Subscription\CreateSubscriptionDTO;
use App\Models\Subscriber;
use App\Services\CaseHandler;

class Create implements CaseHandler
{
    public function __construct(private CreateSubscriptionDTO $createSubscriptionDTO)
    {
    }

    public function handle(): void
    {
        $subscriber = Subscriber::where('email', $this->createSubscriptionDTO->email)->first();

        if (!$subscriber) {
            $subscriber = Subscriber::create([
                'email' => $this->createSubscriptionDTO->email
            ]);
        }

        $subscriber->subscriptionAnimals()->sync($this->createSubscriptionDTO->animal_id);
    }
}
