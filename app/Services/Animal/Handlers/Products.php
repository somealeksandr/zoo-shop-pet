<?php

namespace App\Services\Animal\Handlers;

use App\DTO\Product\FiltersDTO;
use App\Models\Animal;
use App\Services\CaseHandler;
use App\Services\Product\Handlers\Internal\PrepareFilters;
use App\Services\Product\Handlers\Internal\Sort;
use Illuminate\Support\Collection;

class Products implements CaseHandler
{
    public function __construct(private readonly FiltersDTO $filtersDTO, private readonly Animal $animal)
    {
    }

    public function handle(): Collection
    {
        $productsQuery = (new PrepareFilters($this->filtersDTO, $this->animal->products()))->handle();

        $productsQuery = (new Sort($this->filtersDTO, $productsQuery))->handle();

        return $productsQuery->get();
    }
}
