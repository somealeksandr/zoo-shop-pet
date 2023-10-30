<?php

namespace App\Services\Category;

use App\DTO\Profile\FiltersDTO;
use App\Models\Category;
use App\Services\Category\Handlers\Products;

class CategoryService
{
    public function products(FiltersDTO $filtersDTO, Category $category)
    {
        return (new Products($filtersDTO, $category))->handle();
    }
}
