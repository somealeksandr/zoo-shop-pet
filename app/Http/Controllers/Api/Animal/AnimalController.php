<?php

namespace App\Http\Controllers\Api\Animal;

use App\DTO\Product\FiltersDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Product\FiltersProductRequest;
use App\Models\Animal;
use App\Services\Animal\AnimalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class AnimalController extends AbstractApiController
{
    public function __construct(private readonly AnimalService $service)
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

    public function products(FiltersProductRequest $request, Animal $animal): JsonResponse
    {
        $products = $this->service->products(FiltersDTO::fromArray($request->validated()), $animal);

        return $this->success($products, 'Products list by animal');
    }
}
