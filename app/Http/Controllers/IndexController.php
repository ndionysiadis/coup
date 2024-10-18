<?php

namespace App\Http\Controllers;

use App\Data\Menu\MenuTypeData;
use App\Models\MenuType;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\DataCollection;

class IndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,

            'menus' => MenuTypeData::collect(
                MenuType::all(), DataCollection::class)->include('categories.products')
        ]);
    }
}
