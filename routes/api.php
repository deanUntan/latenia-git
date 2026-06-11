<?php

use App\Http\Controllers\Api\GeoFeatureController;
use App\Http\Controllers\Api\PoorHouseholdController;
use App\Http\Controllers\Api\SpbuController;
use App\Http\Controllers\Api\WorshipPlaceController;
use Illuminate\Support\Facades\Route;

// ── GeoTrace Studio ──────────────────────────────────────────
// GET    /api/geotrace       → list all features
// POST   /api/geotrace       → create feature
// PUT    /api/geotrace/{id}  → update feature
// DELETE /api/geotrace/{id}  → delete feature
Route::apiResource('geotrace', GeoFeatureController::class)
    ->parameters(['geotrace' => 'id']);

// ── FuelPoint Manager ─────────────────────────────────────────
// GET    /api/fuelpoint       → list all SPBU
// POST   /api/fuelpoint       → create SPBU
// PUT    /api/fuelpoint/{id}  → update SPBU
// DELETE /api/fuelpoint/{id}  → delete SPBU
Route::apiResource('fuelpoint', SpbuController::class)
    ->parameters(['fuelpoint' => 'id']);

// ── Poverty Map — Worship Places ─────────────────────────────
// GET    /api/worship                 → list all worship places
// POST   /api/worship                 → create worship place
// PUT    /api/worship/{id}            → update worship place
// DELETE /api/worship/{id}            → delete worship place
// POST   /api/worship/recalculate     → recalculate all coverages
Route::post('worship/recalculate', [WorshipPlaceController::class, 'recalculateAction']);
Route::apiResource('worship', WorshipPlaceController::class)
    ->parameters(['worship' => 'id']);

// ── Poverty Map — Poor Households ────────────────────────────
// GET    /api/household       → list all households
// POST   /api/household       → create household
// PUT    /api/household/{id}  → update household
// DELETE /api/household/{id}  → delete household
Route::apiResource('household', PoorHouseholdController::class)
    ->parameters(['household' => 'id']);
