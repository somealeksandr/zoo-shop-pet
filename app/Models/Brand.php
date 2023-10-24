<?php

namespace App\Models;

use App\Presenters\BrandPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use HasFactory, HasTranslations, HasSlug, PresenterTrait;

    protected $table = 'brands';

    protected string $presenter = BrandPresenter::class;

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'slug',
    ];

    protected array $translatable = [
        'title',
        'description',
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return Storage::disk(Arr::get($this->image, 'storage.disk'))->url(Arr::get($this->image, 'sources.cropped'));
        } else {
            return '';
        }
    }
}
