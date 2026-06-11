<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// ── Auth ─────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// ── Admin only ───────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/',          [PageController::class, 'index']);
    Route::get('/geotrace',  [PageController::class, 'geotrace']);
});

// ── Admin + Pemerintah ───────────────────────────────────────
Route::middleware(['auth', 'role:admin,pemerintah'])->group(function () {
    Route::get('/fuelpoint',  [PageController::class, 'fuelpoint']);
    Route::get('/povertymap', [PageController::class, 'povertymap']);
});

// ── All authenticated users ──────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/register-kk', [PageController::class, 'registerKk']);
});
