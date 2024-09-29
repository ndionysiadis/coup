<?php

namespace App\Data\Menu;

use App\Models\MenuType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

class MenuTypeIndexPageData extends Data
{
    /** @var PaginatedDataCollection<MenuTypeData> */
    public PaginatedDataCollection $menuTypes;

    public string $term;

    public function __construct()
    {
        $this->menuTypes = MenuTypeData::collect(
            MenuType::query()
                ->searchIndex()
                ->orderBy('name')
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('totalCategories', 'totalProducts');

        $this->term = request('term') ?? '';
    }
}
