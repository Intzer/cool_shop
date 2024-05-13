<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');

Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
