<?php

namespace App\DTO\Subscription;

use App\DTO\BaseDTO;

class CreateSubscriptionDTO extends BaseDTO
{
    public string $email;

    public array $animal_id;
}
