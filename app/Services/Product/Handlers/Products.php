<?php

namespace App\Services\Product\Handlers;

use App\DTO\Profile\FiltersDTO;
use App\Models\Product;
use App\Services\CaseHandler;
use App\Services\Product\Handlers\Internal\PrepareFilters;

class Products implements CaseHandler
{
    public function __construct(private FiltersDTO $filtersDTO)
    {
    }

    public function handle()
    {
        $productsQuery = (new PrepareFilters($this->filtersDTO, Product::query()))->handle();

        return $productsQuery->get();
    }
}
