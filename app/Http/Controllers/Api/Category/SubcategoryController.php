<?php

namespace App\Http\Controllers\Api\Category;

use App\DTO\Product\FiltersDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Product\FiltersProductRequest;
use App\Models\Subcategory;
use App\Services\Subcategory\SubcategoryService;

class SubcategoryController extends AbstractApiController
{
    public function __construct(private SubcategoryService $service)
    {
    }

    public function index()
    {
        return Subcategory::all();
    }

    public function products(FiltersProductRequest $request, Subcategory $subcategory)
    {
        $products = $this->service->products(FiltersDTO::fromArray($request->validated()), $subcategory);

        return $this->success($products, 'Subcategory products list.');
    }
}
