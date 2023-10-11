<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class ProductPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'description',
        'image',
        'slug',
        'price',
        'promotional_price',
        'is_promotional',
        'quantity',
        'country',
        'brand',
    ];

    public function getCountryPresenter(): string
    {
        return $this->model->country->title;
    }

    public function getBrandPresenter(): string
    {
        return $this->model->brand->title;
    }
}