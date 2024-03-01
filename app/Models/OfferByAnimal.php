<?php

namespace App\Models;

use App\Presenters\OfferByAnimalPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use SomePackage\Presenter\PresenterTrait;
use Spatie\Translatable\HasTranslations;

class OfferByAnimal extends Model
{
    use HasFactory, HasTranslations, PresenterTrait;

    protected $table = 'offer_by_animals';

    protected string $presenter = OfferByAnimalPresenter::class;

    protected $fillable = [
        'id',
        'offer_text',
        'offer_type',
        'image',
        'animal_id',
    ];

    protected array $translatable = ['offer_text', 'offer_type'];

    protected $casts = [
        'image' => 'array',
    ];

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return Storage::disk(Arr::get($this->image, 'storage.disk'))->url(Arr::get($this->image, 'sources.cropped'));
        } else {
            return '';
        }
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}
