<?php

namespace App\Data\Archive;

use App\Data\Category\CategoryData;
use App\Data\Menu\MenuTypeData;
use App\Data\Product\ProductData;
use App\Models\Category;
use App\Models\MenuType;
use App\Models\Product;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

/** @typescript */
class ArchiveData extends Data
{
    public function __construct(
        /** @var DataCollection<MenuTypeData> */
        public DataCollection|null $archivedMenus,

        /** @var DataCollection<CategoryData> */
        public DataCollection|null $archivedCategories,

        /** @var DataCollection<ProductData> */
        public DataCollection|null $archivedProducts
    )
    {
    }

    public static function getArchivedData(): self
    {
        // Apply search and filter only trashed records
        $archivedMenus = MenuType::onlyTrashed()->searchIndex()->get();
        $archivedCategories = Category::onlyTrashed()->searchIndex()->get();
        $archivedProducts = Product::onlyTrashed()->searchIndex()->get();

        return new self(
            archivedMenus: MenuTypeData::collect($archivedMenus),
            archivedCategories: CategoryData::collect($archivedCategories),
            archivedProducts: ProductData::collect($archivedProducts)
        );
    }
}
