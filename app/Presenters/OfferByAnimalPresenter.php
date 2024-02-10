<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class OfferByAnimalPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'offer_text',
        'offer_type',
        'image_url',
        'animal',
    ];

    public function getAnimalPresent(): string
    {
        return $this->model->animal->title;
    }
}
