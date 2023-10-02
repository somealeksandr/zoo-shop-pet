<?php

namespace App\Services\Profile\Handlers;

use App\DTO\Profile\UpdateProfileDTO;
use App\Models\User;
use App\Services\CaseHandler;

class Update implements CaseHandler
{
    public function __construct(protected UpdateProfileDTO $updateProfileDTO)
    {
    }

    public function handle(): User
    {
        $user = $this->updateProfileDTO->user;
        $user->update($this->updateProfileDTO->getUpdateData());

        return $user;
    }
}
