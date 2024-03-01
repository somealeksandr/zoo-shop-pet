<?php

namespace App\Services\Product\Handlers;

use App\DTO\Product\FiltersDTO;
use App\Models\Product;
use App\Services\CaseHandler;
use App\Services\Product\Handlers\Internal\PrepareFilters;
use App\Services\Product\Handlers\Internal\Sort;

class Products implements CaseHandler
{
    public function __construct(private FiltersDTO $filtersDTO)
    {
    }

    public function handle()
    {
        $productsQuery = (new PrepareFilters($this->filtersDTO, Product::query()))->handle();

        $productsQuery = (new Sort($this->filtersDTO, $productsQuery))->handle();

        return $productsQuery->get();
    }
}
