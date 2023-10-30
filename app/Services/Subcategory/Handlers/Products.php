<?php

namespace App\Services\Subcategory\Handlers;

use App\DTO\Profile\FiltersDTO;
use App\Models\Subcategory;
use App\Services\CaseHandler;
use App\Services\Product\Handlers\Internal\PrepareFilters;

class Products implements CaseHandler
{
    public function __construct(private FiltersDTO $filtersDTO, private Subcategory $subcategory)
    {
    }

    public function handle()
    {
        $productsQuery = (new PrepareFilters($this->filtersDTO, $this->subcategory->products()))->handle();

        return $productsQuery->get();
    }
}
