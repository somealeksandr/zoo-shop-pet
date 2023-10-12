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

    public function subscriptionAnimals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_subscriber')->withTimestamps();
    }
}
