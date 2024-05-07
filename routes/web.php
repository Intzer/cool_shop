<?php
use App\Http\Controllers\HomeConstroller;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeConstroller::class, 'index']);
