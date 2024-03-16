<?php

namespace App\Http\Controllers\Api\Product;

use App\DTO\Product\FiltersDTO;
use App\Http\Controllers\AbstractApiController;
use App\Http\Requests\Product\FiltersProductRequest;
use App\Http\Requests\Product\SearchProductRequest;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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

    public function search(SearchProductRequest $request): JsonResponse
    {
        $search = $request->input('search');
        $locale = current_locale();

        $queryProducts = Product::query();
        $queryProducts->where(function($query) use ($search, $locale) {
            $query->where(DB::raw("LOWER(JSON_EXTRACT(title, '$.\"$locale\"'))"), 'LIKE', '%' . strtolower($search) . '%')
                ->orWhere(DB::raw("LOWER(JSON_EXTRACT(description, '$.\"$locale\"'))"), 'LIKE', '%' . strtolower($search) . '%');
        });

        return $this->success($queryProducts->get(), 'Search products result.');
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
