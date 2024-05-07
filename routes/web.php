<?php
use App\Http\Controllers\HomeConstroller;
use App\Http\Controllers\RegisterController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeConstroller::class, 'index']);
Route::post('/', [RegisterController::class, 'index']);
