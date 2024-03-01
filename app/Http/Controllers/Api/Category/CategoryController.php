<?php

namespace App\Http\Controllers\Api\Category;

use App\DTO\Product\FiltersDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Product\FiltersProductRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends AbstractApiController
{
    public function __construct(private readonly CategoryService $service)
    {
    }

    public function index()
    {
        return Category::all();
    }

    public function subcategories(Category $category)
    {
        return $category->subcategories;
    }

    public function products(FiltersProductRequest $request, Category $category): JsonResponse
    {
        $products = $this->service->products(FiltersDTO::fromArray($request->validated()), $category);

        return $this->success($products, 'Category products list.');
    }
}
