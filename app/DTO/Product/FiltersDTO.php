<?php

namespace App\DTO\Product;

use App\DTO\BaseDTO;

final class FiltersDTO extends BaseDTO
{
    public ?array $subcategories;

    public ?int $price_min;

    public ?int $price_max;

    public ?array $countries;

    public ?array $brands;

    public ?bool $new;

    public ?bool $is_promotional;

    public ?string $sort;
}
