<?php

namespace App\Models;

use App\Presenters\CategoryAnimalPresenter;
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

class CategoryAnimal extends Model
{
    use HasFactory, HasTranslations, HasSlug, PresenterTrait;

    protected $table = 'category_animals';

    protected string $presenter = CategoryAnimalPresenter::class;

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
        return $this->belongsToMany(Subscriber::class, 'category_animal_subscriber');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(SubcategoryAnimal::class);
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
