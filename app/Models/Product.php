<?php

namespace App\Models;

use App\Events\MailingSubscriptions;
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
    use HasFactory, HasTranslations, HasSlug, PresenterTrait;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'title',
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
        'description',
    ];

    protected $casts = [
        'image' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function(Product $model) {
            if ($model->is_promotional && $model->promotional_price) {
                event(new MailingSubscriptions($model));
            }
        });

        self::updated(function(Product $model) {
            if ($model->is_promotional && $model->promotional_price) {
                event(new MailingSubscriptions($model));
            }
        });
    }

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
