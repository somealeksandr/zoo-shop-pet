<?php

namespace App\Models;

use App\Presenters\NewsCategoryPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Translatable\HasTranslations;

class NewsCategory extends Model
{
    use HasFactory, HasTranslations, PresenterTrait;

    protected $table = 'news_categories';

    protected string $presenter = NewsCategoryPresenter::class;

    protected $fillable = [
        'id',
        'title',
        'description',
    ];

    protected array $translatable = ['title', 'description'];
}
