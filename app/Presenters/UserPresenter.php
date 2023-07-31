<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class UserPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'name',
        'surname',
        'email',
        'phone_number',
    ];
}
