<?php

namespace App\Data\Archive;

use App\Data\Category\CategoryData;
use App\Data\Menu\MenuTypeData;
use App\Data\Product\ProductData;
use App\Models\Archive;
use App\Models\Category;
use App\Models\MenuType;
use App\Models\Product;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

/** @typescript */
class ArchiveIndexPageData extends Data
{
    /** @var PaginatedDataCollection<MenuTypeData> */
    public PaginatedDataCollection $archivedMenus;

    /** @var PaginatedDataCollection<CategoryData> */
    public PaginatedDataCollection $archivedCategories;

    /** @var PaginatedDataCollection<ProductData> */
    public PaginatedDataCollection $archivedProducts;

    public string $term;

    public function __construct()
    {
        $this->term = request('term') ?? '';

        // Paginate archived menus, categories, and products separately
        $archivedMenus = MenuType::onlyTrashed()
            ->searchIndex()
            ->orderBy('deleted_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $archivedCategories = Category::onlyTrashed()
            ->searchIndex()
            ->orderBy('deleted_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $archivedProducts = Product::onlyTrashed()
            ->searchIndex()
            ->orderBy('deleted_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        // Convert the paginated results to ArchiveData
        $this->archivedMenus = MenuTypeData::collect($archivedMenus, PaginatedDataCollection::class);
        $this->archivedCategories = CategoryData::collect($archivedCategories, PaginatedDataCollection::class);
        $this->archivedProducts = ProductData::collect($archivedProducts, PaginatedDataCollection::class);
    }
}
