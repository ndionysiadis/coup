<?php

namespace App\Data\Menu;

use App\Data\Category\CategoryData;
use App\Models\MenuType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

/** @typescript */
class MenuTypeShowPageData extends Data
{
    public MenuTypeData $menuType;

    /** @var PaginatedDataCollection<CategoryData> */
    public PaginatedDataCollection $categories;

    public string $term;

    public function __construct(MenuType $menuType)
    {
        $this->menuType = MenuTypeData::from($menuType)
            ->include('totalProducts');

        $this->categories = CategoryData::collect(
            $menuType->categories()
                ->searchShow()
                ->orderBy('name')
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        );

        $this->term = request('term') ?? '';
    }
}

