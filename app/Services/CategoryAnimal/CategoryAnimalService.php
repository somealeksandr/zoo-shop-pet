<?php

namespace App\Services\CategoryAnimal;

use App\Services\CategoryAnimal\Handlers\Index;

class CategoryAnimalService
{
    public function index()
    {
        return (new Index())->handle();
    }
}
