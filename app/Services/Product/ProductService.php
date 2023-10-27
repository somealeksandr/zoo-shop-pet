<?php

namespace App\Services\Product;

use App\DTO\Profile\FiltersDTO;
use App\Models\Product;
use App\Services\Product\Handlers\Filters;
use App\Services\Product\Handlers\Products;
use App\Services\Product\Handlers\ToggleFavorite;

class ProductService
{
    public function toggleFavorite(Product $product)
    {
        (new ToggleFavorite($product))->handle();
    }

    public function products(FiltersDTO $filtersDTO)
    {
        return (new Products($filtersDTO))->handle();
    }

    public function filters(FiltersDTO $filtersDTO, $slug)
    {
        return (new Filters($filtersDTO, $slug))->handle();
    }
}
