<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class SubcategoryPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'description',
        'slug',
        'category',
    ];

    public function getCategoryPresent(): string
    {
        return $this->model->category->title;
    }
}
