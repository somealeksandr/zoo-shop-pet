<?php

namespace App\Http\Controllers\Api\Animal;

use App\Http\Controllers\AbstractApiController;
use App\Models\Animal;
use App\Services\Animal\AnimalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class AnimalController extends AbstractApiController
{
    public function __construct(private AnimalService $service)
    {
        return Animal::all();
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function categories(Animal $animal): Collection
    {
        return $animal->categories;
    }

    public function products(Animal $animal): JsonResponse
    {
        return $this->success($animal->products, 'Products list by animal');
    }
}
