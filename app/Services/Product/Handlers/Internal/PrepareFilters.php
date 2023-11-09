<?php

namespace App\Services\Product\Handlers\Internal;

use App\Models\Subcategory;
use App\Services\CaseHandler;
use Carbon\Carbon;

class PrepareFilters implements CaseHandler
{
    public function __construct(protected $dto, protected $productsQuery)
    {
    }

    public function handle()
    {
        $dto = $this->dto;
        $productsQuery = $this->productsQuery;

        if (isset($dto->subcategories)) {
            $subcategoryIds = Subcategory::whereIn('slug', array($dto->subcategories))->pluck('id')->toArray();
            $productsQuery->whereHas('subcategory', function ($query) use ($subcategoryIds) {
                $query->whereIn('subcategory_id', $subcategoryIds);
            });
        }

        if (isset($dto->price_min) && isset($dto->price_max)) {
            $productsQuery->whereBetween('price', array($dto->price_min, $dto->price_max));
        }

        if ($dto->brands) {
            $productsQuery->whereHas('brand', function ($query) use ($dto) {
                $query->whereIn('slug', array($dto->brands));
            });
        }

        if ($dto->countries) {
            $productsQuery->whereHas('country', function ($query) use ($dto) {
                $query->whereIn('slug', array($dto->countries));
            });
        }

        if ($dto->is_promotional) {
            $productsQuery->where('is_promotional', true);
        }

        if ($dto->new) {
            $productsQuery->where('products.created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString());
        }

        return $productsQuery;
    }
}
