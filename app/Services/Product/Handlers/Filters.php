<?php

namespace App\Services\Product\Handlers;

use App\DTO\Product\FiltersDTO;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Subcategory;
use App\Services\CaseHandler;
use App\Services\Product\Handlers\Internal\PrepareFilters;

class Filters implements CaseHandler
{
    public function __construct(private FiltersDTO $filtersDTO, private string $slug)
    {
    }

    public function handle()
    {
        $model = $this->getModel($this->slug);
        $productsQuery = $model::whereSlug($this->slug)->first()->products();

        $productsQuery = (new PrepareFilters($this->filtersDTO, $productsQuery))->handle();

        $products = $productsQuery->get();
        $productIds = $products->pluck('id')->toArray();

        $subcategories = [];
        $category = Category::whereSlug($this->slug)->first();
        foreach (Subcategory::where('category_id', $category->id)->get() as $subcategory) {
            $subcategories[$subcategory->title] = [
                'count' => $subcategory->products()->whereIn('product_id', $productIds)->count(),
                'slug' => $subcategory->slug
            ];
        }

        $brands = [];
        foreach (Brand::all() as $brand) {
            $brands[$brand->title] = [
                'count' => $this->getProductsCondition($brand, $productIds),
                'slug' => $brand->slug
            ];
        }

        $countries = [];
        foreach (Country::all() as $country) {
            $countries[$country->title] = [
                'count' => $this->getProductsCondition($country, $productIds),
                'slug' => $country->slug
            ];
        }

        $min = $products->where('price', $products->min('price'))->first();
        $max = $products->where('price', $products->max('price'))->first();

        $prices = [$min->price ?? 0, $max->price ?? 0];

        return [
            'category' => $category->title,
            'animal' => $category->animal->title,
            'subcategories' => $subcategories,
            'brands' => $brands,
            'countries' => $countries,
            'prices' => $prices,
        ];
    }

    private function getModel($slug)
    {
        if (Category::whereSlug($slug)->exists()) {
            return Category::class;
        }

        return Subcategory::class;
    }

    private function getProductsCondition($relation, array $conditions): int
    {
        return $relation->products()->whereIn('id', $conditions)->count();
    }
}
