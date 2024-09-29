<?php

namespace App\Repositories;
use App\Data\Menu\MenuTypeData;
use App\Models\Category;
use App\Models\MenuType;
use Illuminate\Support\Facades\DB;
use Throwable;

class MenuRepository
{
    public function __construct(public MenuType $menuType)
    {
    }

    /**
     * @throws Throwable
     */
    public static function store(MenuTypeData $request): void
    {
        DB::transaction(function () use ($request) {
            $menuType = MenuType::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if (!empty($request->categories)) {
                foreach ($request->categories as $category) {
                    Category::where('id', $category->id)->update([
                        'menu_id' => $menuType->id
                    ]);
                }
            }
        });
    }

    public static function update(MenuTypeData $request, MenuType $menuType): void
    {
        DB::transaction(function () use ($request, $menuType) {
            $menuType->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if (is_null($request->categories)) {
                Category::where('menu_id', $menuType->id)->update([
                    'menu_id' => null
                ]);
            } else {
                foreach ($request->categories as $category) {
                    Category::where('id', $category->id)->update([
                        'menu_id' => $menuType->id
                    ]);
                }

                Category::where('menu_id', $menuType->id)
                    ->whereNotIn('id', collect($request->categories)->pluck('id'))
                    ->update(['menu_id' => null]);
            }
        });
    }
}
