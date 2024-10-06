<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::controller(ProfileController::class)
            ->prefix('profile')
            ->name('profile.')
            ->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
//                Route::delete('/', 'destroy')->name('destroy');
            });

        Route::get('menu/archived', [MenuController::class, 'archived'])->name('menu.archived');
        Route::post('menu/{menuType}/restore', [MenuController::class, 'restore'])->name('menu.restore');

        Route::get('category/archived', [CategoryController::class, 'archived'])->name('category.archived');
        Route::post('category/{category}/restore', [CategoryController::class, 'restore'])->name('category.restore');

        Route::get('product/archived', [ProductController::class, 'archived'])->name('product.archived');
        Route::post('product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');

        Route::resource('menu', MenuController::class)->parameters(['menu' => 'menuType']);
        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);


    });

require __DIR__ . '/auth.php';

