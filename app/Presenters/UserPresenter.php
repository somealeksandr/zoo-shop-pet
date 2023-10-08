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
        'subscriptions',
    ];

    public function getSubscriptionsPresent()
    {
        return $this->model->subscriptions;
    }
}
