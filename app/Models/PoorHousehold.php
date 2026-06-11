<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoorHousehold extends Model
{
    protected $table = 'poor_households';

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'is_covered',
    ];

    protected $casts = [
        'latitude'   => 'float',
        'longitude'  => 'float',
        'is_covered' => 'boolean',
    ];
}
