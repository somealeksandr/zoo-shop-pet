<?php

namespace App\Presenters;

use App\Models\GeneralSetting;
use Carbon\Carbon;
use SomePackage\Presenter\AbstractPresenter;

class ProductPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'short_description',
        'description',
        'image_url',
        'slug',
        'price',
        'promotional_price',
        'is_promotional',
        'is_new',
        'quantity',
        'country',
        'brand',
        'animal',
        'category',
        'subcategory',
    ];

    public function getCountryPresent(): object
    {
        return $this->model->country;
    }

    public function getBrandPresent(): string
    {
        return $this->model->brand->title;
    }

    public function getAnimalPresent(): ?array
    {
        return $this->getRelationPresent($this->model->animal);
    }

    public function getCategoryPresent(): ?array
    {
        return $this->getRelationPresent($this->model->category);
    }

    public function getSubcategoryPresent(): ?array
    {
        return $this->getRelationPresent($this->model->subcategory);
    }

    public function getIsNewPresent(): ?bool
    {
        $days = GeneralSetting::first()->days_product_is_new;
        return $this->created_at >= Carbon::now()->subDays($days)->toDateTimeString();
    }

    private function getRelationPresent($relation): ?array
    {
        return [
            'title' => $relation?->first()?->title,
            'slug' => $relation?->first()?->slug,
        ];
    }
}
