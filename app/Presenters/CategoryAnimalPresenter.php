<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class CategoryAnimalPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'description',
        'slug',
        'icon_url',
    ];
}
