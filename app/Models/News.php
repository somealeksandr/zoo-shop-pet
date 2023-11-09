<?php

namespace App\Models;

use App\Presenters\NewsPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasFactory, HasTranslations, HasSlug, PresenterTrait;

    protected $table = 'news';

    protected string $presenter = NewsPresenter::class;

    protected $fillable = [
        'id',
        'title',
        'content',
        'image',
        'category_id',
        'slug',
        'reading_time_minutes',
        'published_at',
    ];

    protected array $translatable = ['title', 'content'];

    protected $casts = [
        'image' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return Storage::disk(Arr::get($this->image, 'storage.disk'))->url(Arr::get($this->image, 'sources.cropped'));
        } else {
            return '';
        }
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class);
    }
}
