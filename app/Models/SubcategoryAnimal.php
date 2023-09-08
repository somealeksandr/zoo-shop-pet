<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class SubcategoryAnimal extends Model
{
    use HasFactory, HasTranslations, HasSlug;

    protected $table = 'subcategory_animals';

    protected $fillable = [
        'id',
        'title',
        'description',
        'slug',
        'category_animal_id',
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

    public function categoryAnimal(): BelongsTo
    {
        return $this->belongsTo(CategoryAnimal::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_subcategory_animal');
    }

    public function getTitleOptionAttribute(): string
    {
        return $this->categoryAnimal->title . ' - ' . Str::upper($this->title);
    }
}
