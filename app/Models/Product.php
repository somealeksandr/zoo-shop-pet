<?php

namespace App\Models;

use App\Presenters\ProductPresenter;
use App\Traits\FullTextSearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations, HasSlug, PresenterTrait, FullTextSearchTrait;

    protected $table = 'products';

    protected string $presenter = ProductPresenter::class;

    protected $fillable = [
        'id',
        'title',
        'short_description',
        'description',
        'image',
        'slug',
        'price',
        'promotional_price',
        'is_promotional',
        'quantity',
        'country_id',
        'brand_id',
    ];

    protected array $translatable = [
        'title',
        'short_description',
        'description',
    ];

    protected $searchable = [
        'title',
        'description'
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

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function animal(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_product');
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function subcategory(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'product_subcategory');
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
