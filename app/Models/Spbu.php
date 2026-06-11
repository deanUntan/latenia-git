<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spbu extends Model
{
    protected $table = 'spbu';

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'is_24_hours',
    ];

    protected $casts = [
        'latitude'    => 'float',
        'longitude'   => 'float',
        'is_24_hours' => 'boolean',
    ];
}
