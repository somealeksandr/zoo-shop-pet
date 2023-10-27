<?php

namespace App\Http\Controllers\Api\Product;

use App\DTO\Profile\FiltersDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Product\FiltersProductRequest;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends AbstractApiController
{
    public function __construct(private ProductService $service)
    {
    }

    public function index(FiltersProductRequest $request): JsonResponse
    {
        $products = $this->service->products(FiltersDTO::fromArray($request->validated()));

        return $this->success($products, 'Products list.');
    }

    public function getProduct(Product $product)
    {
        return $product;
    }

    public function toggleFavorite(Product $product)
    {
        $this->service->toggleFavorite($product);
    }

    public function getFiltersWithCounts(FiltersProductRequest $request, $slug): JsonResponse
    {
        $filters = $this->service->filters(FiltersDTO::fromArray($request->validated()), $slug);

        return $this->success($filters, 'Filters list.');
    }
}
