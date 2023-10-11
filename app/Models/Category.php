<?php

namespace App\Models;

use App\Presenters\CategoryPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations, HasSlug, PresenterTrait;

    protected $table = 'categories';

    protected string $presenter = CategoryPresenter::class;

    protected $fillable = [
        'id',
        'title',
        'description',
        'slug',
        'animal_id',
    ];

    protected array $translatable = [
        'title',
        'description',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function getTitleOptionAttribute(): string
    {
        if ($this->animal) {
            return $this->animal->title . ' - ' . Str::upper($this->title);
        }
        return Str::upper($this->title);
    }
}
