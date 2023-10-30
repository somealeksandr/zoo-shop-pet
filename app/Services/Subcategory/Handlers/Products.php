<?php

namespace App\Services\Subcategory\Handlers;

use App\DTO\Profile\FiltersDTO;
use App\Models\Subcategory;
use App\Services\CaseHandler;
use App\Services\Product\Handlers\Internal\PrepareFilters;
use App\Services\Product\Handlers\Internal\Sort;

class Products implements CaseHandler
{
    public function __construct(private FiltersDTO $filtersDTO, private Subcategory $subcategory)
    {
    }

    public function handle()
    {
        $productsQuery = (new PrepareFilters($this->filtersDTO, $this->subcategory->products()))->handle();

        $productsQuery = (new Sort($this->filtersDTO, $productsQuery))->handle();

        return $productsQuery->get();
    }
}
