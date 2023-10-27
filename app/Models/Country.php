<?php

namespace App\Models;

use App\Presenters\CountryPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory, HasTranslations, HasSlug, PresenterTrait;

    protected $table = 'countries';

    protected string $presenter = CountryPresenter::class;

    protected $fillable = [
        'id',
        'title',
        'icon',
        'slug',
        'code',
    ];

    protected array $translatable = ['title'];

    protected $casts = [
        'icon' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug');
    }

    public function getIconUrlAttribute(): string
    {
        if ($this->icon) {
            return Storage::disk(Arr::get($this->icon, 'storage.disk'))->url(Arr::get($this->icon, 'sources.cropped'));
        } else {
            return '';
        }
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
