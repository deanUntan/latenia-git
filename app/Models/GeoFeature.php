<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoFeature extends Model
{
    protected $table = 'geo_features';

    protected $fillable = [
        'name',
        'description',
        'type',
        'color',
        'coordinates',
    ];

    protected $casts = [
        'coordinates' => 'array',
    ];
}
