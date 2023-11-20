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
        'subcategories',
    ];

    public function getAnimalPresent(): string
    {
        return $this->model->animal->title;
    }

    public function getSubcategoriesPresent(): array
    {
        $data = [];
        foreach ($this->model->subcategories as $subcategory) {
            $data[] = [
                'id' => $subcategory->id,
                'title' => $subcategory->title,
                'slug' => $subcategory->slug,
            ];
        }

        return $data;
    }
}
