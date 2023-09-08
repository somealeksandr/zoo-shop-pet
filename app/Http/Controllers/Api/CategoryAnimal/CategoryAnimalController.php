<?php

namespace App\Http\Controllers\Api\CategoryAnimal;

use App\Http\Controllers\AbstractApiController;
use App\Models\CategoryAnimal;

class CategoryAnimalController extends AbstractApiController
{
    public function index()
    {
        return CategoryAnimal::all();
    }
}
