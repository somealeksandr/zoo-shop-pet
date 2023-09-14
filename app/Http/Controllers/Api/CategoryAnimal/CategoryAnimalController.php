<?php

namespace App\Http\Controllers\Api\CategoryAnimal;

use App\Http\Controllers\AbstractApiController;
use App\Services\CategoryAnimal\CategoryAnimalService;
use Illuminate\Support\Collection;

class CategoryAnimalController extends AbstractApiController
{
    public function __construct(private CategoryAnimalService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }
}
