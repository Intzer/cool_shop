<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttributeSetsController;
use App\Http\Controllers\AttributeTemplatesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories.index');
    Route::post('/admin/categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoriesController::class, 'delete'])->name('admin.categories.delete');
    Route::post('/admin/categories/{product}/tocategory', [CategoriesController::class, 'attachattributeset'])->name('admin.categories.attachattributeset');
    Route::post('/admin/categories/{product}/fromcategory', [CategoriesController::class, 'detachattributeset'])->name('admin.categories.detachattributeset');

    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products.index');
    Route::post('/admin/products', [ProductsController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductsController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductsController::class, 'delete'])->name('admin.products.delete');
    Route::post('/admin/products/{product}/tocategory', [ProductsController::class, 'tocategory'])->name('admin.products.tocategory');
    Route::post('/admin/products/{product}/fromcategory', [ProductsController::class, 'fromcategory'])->name('admin.products.fromcategory');

    Route::get('/admin/customers', [AdminController::class, 'customers'])->name('admin.customers.index');
    Route::post('/admin/customers', [CustomerController::class, 'store'])->name('admin.customers.store');
    Route::get('/admin/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('/admin/customers/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/admin/customers/{customer}', [CustomerController::class, 'delete'])->name('admin.customers.delete');

    Route::get('/admin/attributesets', [AdminController::class, 'attributeSets'])->name('admin.attributesets.index');
    Route::post('/admin/attributesets', [AttributeSetsController::class, 'store'])->name('admin.attributesets.store');
    Route::get('/admin/attributesets/{attributeSet}/edit', [AttributeSetsController::class, 'edit'])->name('admin.attributesets.edit');
    Route::put('/admin/attributesets/{attributeSet}', [AttributeSetsController::class, 'update'])->name('admin.attributesets.update');
    Route::delete('/admin/attributesets/{attributeSet}', [AttributeSetsController::class, 'delete'])->name('admin.attributesets.delete');

    Route::get('/admin/attributetemplates', [AdminController::class, 'attributeTemplates'])->name('admin.attributetemplates.index');
    Route::post('/admin/attributetemplates', [AttributeTemplatesController::class, 'store'])->name('admin.attributetemplates.store');
    Route::get('/admin/attributetemplates/{attributeTemplate}/edit', [AttributeTemplatesController::class, 'edit'])->name('admin.attributetemplates.edit');
    Route::put('/admin/attributetemplates/{attributeTemplate}', [AttributeTemplatesController::class, 'update'])->name('admin.attributetemplates.update');
    Route::delete('/admin/attributetemplates/{attributeTemplate}', [AttributeTemplatesController::class, 'delete'])->name('admin.attributetemplates.delete');
});

Route::get('/', [ProductsController::class, 'index'])->name('products.index');

Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/products/category/{category}', [ProductsController::class, 'showCategory'])->name('products.show.category');
