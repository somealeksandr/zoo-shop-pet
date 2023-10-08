<?php

namespace App\Http\Controllers\Api\CategoryAnimal;

use App\Http\Controllers\AbstractApiController;
use App\Models\Animal;

class CategoryAnimalController extends AbstractApiController
{
    public function index()
    {
        return Animal::all();
    }
}
