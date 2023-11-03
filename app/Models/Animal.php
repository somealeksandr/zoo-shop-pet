<?php

namespace App\Models;

use App\Presenters\AnimalPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Animal extends Model
{
    use HasFactory, HasTranslations, HasSlug, PresenterTrait;

    protected $table = 'animals';

    protected string $presenter = AnimalPresenter::class;

    protected $fillable = [
        'id',
        'title',
        'description',
        'icon',
        'slug',
    ];

    protected array $translatable = [
        'title',
        'description',
    ];

    protected $casts = [
        'icon' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug');
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class, 'animal_subscriber');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'animal_product');
    }

    public function getIconUrlAttribute(): string
    {
        if ($this->icon) {
            return Storage::disk(Arr::get($this->icon, 'storage.disk'))->url(Arr::get($this->icon, 'sources.cropped'));
        } else {
            return '';
        }
    }
}
