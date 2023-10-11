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
}
