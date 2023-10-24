<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class CountryPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'icon_url',
        'slug',
        'code',
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
