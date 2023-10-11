<?php

namespace App\Http\Controllers\Api\Animal;

use App\Http\Controllers\AbstractApiController;
use App\Models\Animal;

class AnimalController extends AbstractApiController
{
    public function index()
    {
        return Animal::all();
    }
}
