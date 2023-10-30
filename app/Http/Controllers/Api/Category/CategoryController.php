<?php

namespace App\Http\Controllers\Api\Category;

use App\DTO\Profile\FiltersDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Product\FiltersProductRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;

class CategoryController extends AbstractApiController
{
    public function __construct(private CategoryService $service)
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

    public function products(FiltersProductRequest $request, Category $category)
    {
        $products = $this->service->products(FiltersDTO::fromArray($request->validated()), $category);

        return $this->success($products, 'Category products list.');
    }
}
