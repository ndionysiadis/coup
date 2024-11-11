<?php

namespace App\Http\Controllers\Api;

use App\Data\Category\CategoryData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $lazyProperties = request('lazyProperties', []);

        $categories = CategoryData::collect(
            Category::query()
                ->orderBy('order')
                ->searchIndex(request('term'))
                ->paginate(request('perPage'))
        );

        foreach ($lazyProperties as $property) {
            $categories->include($property);
        }

        return response()->json($categories);
    }
}
