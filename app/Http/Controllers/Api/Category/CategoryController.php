<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\AbstractApiController;
use App\Models\Category;

class CategoryController extends AbstractApiController
{
    public function index()
    {
        return Category::all();
    }

    public function subcategories(Category $category)
    {
        return $category->subcategories;
    }

    public function products(Category $category)
    {
        return $category->products;
    }
}
