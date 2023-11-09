<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class NewsCategoryPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
    ];
}
