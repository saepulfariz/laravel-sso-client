<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// login
Route::get('login', [AuthController::class, 'login'])->name('login');

Route::get('/auth/', [AuthController::class, 'index'])->name('auth.index');
// sso callback
Route::get('/sso/callback', [AuthController::class, 'callback'])->name('sso.callback');

// protected routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
// Route::middleware('auth')->group(function () {});

Route::get('/', function () {
    return view('welcome');
});
