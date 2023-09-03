<?php

namespace App\Models;

use Yaro\Jarboe\Models\Admin as JarboeAdmin;

final class Admin extends JarboeAdmin
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'remember_token',
    ];
}
