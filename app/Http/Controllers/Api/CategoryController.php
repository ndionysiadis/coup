<?php

namespace App\Http\Controllers\Api;

use App\Data\Category\CategoryData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $categories = CategoryData::collect(
            Category::whereNull('deleted_at')->get()
        );

        return response()->json($categories);
    }
}
