<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\AbstractApiController;
use App\Models\Product;

class ProductController extends AbstractApiController
{
    public function index()
    {
        return Product::all();
    }
}
