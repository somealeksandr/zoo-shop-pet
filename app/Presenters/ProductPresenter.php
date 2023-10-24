<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class ProductPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'description',
        'image_url',
        'slug',
        'price',
        'promotional_price',
        'is_promotional',
        'quantity',
        'country',
        'brand',
    ];

    public function getCountryPresent(): object
    {
        return $this->model->country;
    }

    public function getBrandPresent(): string
    {
        return $this->model->brand->title;
    }
}
