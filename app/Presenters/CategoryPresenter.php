<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class CategoryPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'description',
        'slug',
        'animal',
    ];

    public function getAnimalPresent(): string
    {
        return $this->model->animal->title;
    }
}
