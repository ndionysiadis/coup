<?php

namespace App\Http\Controllers\Api;

use App\Data\Product\ProductData;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $lazyProperties = request('lazyProperties', []);

        $products = ProductData::collect(
            Product::query()
                ->whereNull('category_id')
                ->orderBy('order')
                ->searchIndex(request('term'))
                ->paginate(request('perPage'))
        );

        foreach ($lazyProperties as $property) {
            $products->include($property);
        }

        return response()->json($products);
    }
}
