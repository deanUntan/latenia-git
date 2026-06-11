<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorshipPlace extends Model
{
    protected $table = 'worship_places';

    protected $fillable = [
        'name',
        'type',
        'description',
        'latitude',
        'longitude',
        'radius',
    ];

    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
        'radius'    => 'float',
    ];
}
