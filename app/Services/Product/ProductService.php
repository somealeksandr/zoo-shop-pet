<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\Product\Handlers\ToggleFavorite;

class ProductService
{
    public function toggleFavorite(Product $product)
    {
        (new ToggleFavorite($product))->handle();
    }
}
