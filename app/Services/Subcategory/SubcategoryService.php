<?php

namespace App\Services\Subcategory;

use App\DTO\Product\FiltersDTO;
use App\Models\Subcategory;
use App\Services\Subcategory\Handlers\Products;

class SubcategoryService
{
    public function products(FiltersDTO $filtersDTO, Subcategory $subcategory)
    {
        return (new Products($filtersDTO, $subcategory))->handle();
    }
}
