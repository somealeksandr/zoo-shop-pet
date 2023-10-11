<?php

namespace App\Models;

use App\Presenters\SubcategoryPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Subcategory extends Model
{
    use HasFactory, HasTranslations, HasSlug, PresenterTrait;

    protected $table = 'subcategories';

    protected string $presenter = SubcategoryPresenter::class;

    protected $fillable = [
        'id',
        'title',
        'description',
        'slug',
        'category_id',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_subcategory');
    }

    public function getTitleOptionAttribute(): string
    {
        return $this->category->title . ' - ' . Str::upper($this->title) ?? Str::upper($this->title);
    }
}
