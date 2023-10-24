<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\AbstractApiController;
use App\Models\Product;
use App\Services\Product\ProductService;

class ProductController extends AbstractApiController
{
    public function __construct(private ProductService $service)
    {
    }

    public function index()
    {
        return Product::all();
    }

    public function toggleFavorite(Product $product)
    {
        $this->service->toggleFavorite($product);
    }
}
