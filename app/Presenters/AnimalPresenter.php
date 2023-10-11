<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class AnimalPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'slug',
        'icon_url',
    ];
}
