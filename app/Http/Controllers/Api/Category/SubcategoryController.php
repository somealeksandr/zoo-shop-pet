<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\AbstractApiController;
use App\Models\Subcategory;

class SubcategoryController extends AbstractApiController
{
    public function index()
    {
        return Subcategory::all();
    }
}
