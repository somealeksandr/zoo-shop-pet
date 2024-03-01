<?php

namespace App\Services\Animal;

use App\DTO\Product\FiltersDTO;
use App\Models\Animal;
use App\Services\Animal\Handlers\Index;
use App\Services\Animal\Handlers\Products;
use Illuminate\Support\Collection;

class AnimalService
{
    public function index(): Collection
    {
        return (new Index())->handle();
    }

    public function products(FiltersDTO $filtersDTO, Animal $animal): Collection
    {
        return (new Products($filtersDTO, $animal))->handle();
    }
}
