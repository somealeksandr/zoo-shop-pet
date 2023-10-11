<?php

namespace App\Services\Animal;

use App\Services\Animal\Handlers\Index;

class AnimalService
{
    public function index()
    {
        return (new Index())->handle();
    }
}
