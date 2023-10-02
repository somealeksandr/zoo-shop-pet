<?php

namespace App\Services\Profile;

use App\DTO\Profile\UpdatePasswordDTO;
use App\DTO\Profile\UpdateProfileDTO;
use App\Models\User;
use App\Services\Profile\Handlers\Update;
use App\Services\Profile\Handlers\UpdatePassword;

class ProfileService
{
    public function update(UpdateProfileDTO $updateProfileDTO): User
    {
        return (new Update($updateProfileDTO))->handle();
    }

    public function updatePassword(UpdatePasswordDTO $updatePasswordDTO): void
    {
        (new UpdatePassword($updatePasswordDTO))->handle();
    }
}
