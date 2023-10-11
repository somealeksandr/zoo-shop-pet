<?php

namespace App\Services\Animal\Handlers;

use App\Models\Animal;
use App\Services\CaseHandler;
use Illuminate\Support\Collection;

class Index implements CaseHandler
{
    public function handle(): Collection
    {
        return Animal::all();
    }
}
