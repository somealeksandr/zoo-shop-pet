<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class NewsPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'title',
        'content',
        'image_url',
        'category',
        'slug',
        'reading_time_minutes',
        'published_at',
    ];

    public function getCategoryPresent(): string
    {
        return $this->model->category->title;
    }
}
