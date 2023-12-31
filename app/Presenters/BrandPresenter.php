<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class BrandPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'description',
        'image_url',
        'slug',
    ];

    public function getCountryPresent(): string
    {
        return $this->model->country->title;
    }

    public function getBrandPresent(): string
    {
        return $this->model->brand->title;
    }
}
