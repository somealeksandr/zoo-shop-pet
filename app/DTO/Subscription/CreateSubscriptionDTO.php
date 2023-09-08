<?php

namespace App\DTO\Subscription;

use App\DTO\BaseDTO;

class CreateSubscriptionDTO extends BaseDTO
{
    public string $email;

    public array $category_animal_id;
}
