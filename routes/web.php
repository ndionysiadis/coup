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
                Route::delete('/', 'destroy')->name('destroy');
            });

        Route::controller(MenuController::class)
            ->prefix('menu')
            ->name('menu.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/{menuType}', 'show')->name('show');
                Route::get('/{menuType}/edit', 'edit')->name('edit');
                Route::post('/', 'store')->name('store');
                Route::put('/{menuType}', 'update')->name('update');
                Route::delete('/{menuType}', 'destroy')->name('destroy');
            });

        Route::controller(CategoryController::class)
            ->prefix('category')
            ->name('category.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{category}', 'show')->name('show');
                Route::get('/{category}/edit', 'edit')->name('edit');
                Route::patch('/{category}', 'update')->name('update');
                Route::delete('/{category}', 'destroy')->name('destroy');
            });

        Route::controller(ProductController::class)
            ->prefix('product')
            ->name('product.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{product}', 'show')->name('show');
                Route::get('/{product}/edit', 'edit')->name('edit');
                Route::patch('/{product}', 'update')->name('update');
                Route::delete('/{product}', 'destroy')->name('destroy');
            });
    });

require __DIR__ . '/auth.php';

