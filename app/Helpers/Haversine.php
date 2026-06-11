<?php

namespace App\Helpers;

class Haversine
{
    /**
     * Calculate distance between two coordinates using Haversine formula.
     * Returns distance in metres.
     */
    public static function distance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $R  = 6371000;
        $p1 = deg2rad($lat1);
        $p2 = deg2rad($lat2);
        $dp = deg2rad($lat2 - $lat1);
        $dl = deg2rad($lon2 - $lon1);
        $a  = sin($dp / 2) ** 2 + cos($p1) * cos($p2) * sin($dl / 2) ** 2;

        return $R * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }
}
