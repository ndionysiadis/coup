<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')
    ->name('api.')
    ->group(function () {
        Route::get('menus', [MenuController::class, 'index'])->name('menu.index');
        Route::get('categories', [CategoryController::class, 'index'])->name('category.index');
        Route::get('products', [ProductController::class, 'index'])->name('product.index');
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
