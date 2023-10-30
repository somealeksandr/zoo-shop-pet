<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class AnimalPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'description',
        'categories',
        'slug',
        'icon_url',
    ];

    public function getCategoriesPresent(): ?object
    {
        return $this->model->categories;
    }
}
