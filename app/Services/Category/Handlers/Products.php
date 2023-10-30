<?php

namespace App\Services\Category\Handlers;

use App\DTO\Profile\FiltersDTO;
use App\Models\Category;
use App\Services\CaseHandler;
use App\Services\Product\Handlers\Internal\PrepareFilters;

class Products implements CaseHandler
{
    public function __construct(private FiltersDTO $filtersDTO, private Category $category)
    {
    }

    public function handle()
    {
        $productsQuery = (new PrepareFilters($this->filtersDTO, $this->category->products()))->handle();

        return $productsQuery->get();
    }
}
