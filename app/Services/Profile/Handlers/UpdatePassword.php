<?php

namespace App\Services\Profile\Handlers;

use App\DTO\Profile\UpdatePasswordDTO;
use App\Services\CaseHandler;

class UpdatePassword implements CaseHandler
{
    public function __construct(private UpdatePasswordDTO $passwordDTO)
    {
    }

    public function handle()
    {
        $user = $this->passwordDTO->user;

        $user->update([
            'password' => bcrypt($this->passwordDTO->new_password)
        ]);
    }
}
