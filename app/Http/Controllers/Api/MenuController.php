<?php

namespace App\Http\Controllers\Api;

use App\Data\Menu\MenuTypeData;
use App\Http\Controllers\Controller;
use App\Models\MenuType;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function index(): JsonResponse
    {
        $lazyProperties = request('lazyProperties', []);

        $menus = MenuTypeData::collect(
            MenuType::query()
            ->orderBy('name')
            ->searchIndex(request('term'))
            ->paginate(request('perPage'))
        );

        foreach ($lazyProperties as $property) {
            $menus->include($property);
        }

        return response()->json($menus);
    }
}
