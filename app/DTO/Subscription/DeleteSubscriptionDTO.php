<?php

namespace App\DTO\Subscription;

use App\DTO\BaseDTO;
use App\Models\User;

class DeleteSubscriptionDTO extends BaseDTO
{
    public User $user;

    public int $animal_id;
}
