<?php

namespace App\Repositories;

use App\Data\Category\CategoryData;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryRepository
{
    public function __construct(public Category $category)
    {
    }

    /**
     * @throws Throwable
     */
    public static function store(CategoryData $request): void
    {
        DB::transaction(function () use ($request) {
            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'menu_id' => $request->menuType->id
            ]);

            if (!empty($request->products)) {
                foreach ($request->products as $product) {
                    Product::where('id', $product->id)->update([
                        'category_id' => $category->id
                    ]);
                }
            }
        });
    }

    public static function update(CategoryData $request, Category $category): void
    {
        DB::transaction(function () use ($request, $category) {
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'menu_id' => $request->menuType?->id
            ]);

            if (is_null($request->products)) {
                Product::where('category_id', $category->id)->update([
                    'category_id' => null
                ]);
            } else {
                foreach ($request->products as $product) {
                    Product::where('id', $product->id)->update([
                        'category_id' => $category->id
                    ]);
                }

                Product::where('category_id', $category->id)
                    ->whereNotIn('id', collect($request->products)->pluck('id'))
                    ->update(['category_id' => null]);
            }
        });
    }

}
