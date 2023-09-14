<?php

namespace App\Services\CategoryAnimal\Handlers;

use App\Models\CategoryAnimal;
use App\Services\CaseHandler;
use Illuminate\Support\Collection;

class Index implements CaseHandler
{
    public function handle(): Collection
    {
        return CategoryAnimal::all();
    }
}
