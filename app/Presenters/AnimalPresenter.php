<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class AnimalPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'description',
        'category',
        'slug',
        'icon_url',
    ];

    public function getCategoryPresenter()
    {
        return $this->model->category;
    }
}
