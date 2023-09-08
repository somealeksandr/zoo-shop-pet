<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscriber extends Model
{
    use HasFactory;

    protected $table = 'subscribers';

    protected $fillable = [
        'id',
        'email',
    ];

    public function subscriptionCategories(): BelongsToMany
    {
        return $this->belongsToMany(CategoryAnimal::class, 'category_animal_subscriber')->withTimestamps();
    }
}
