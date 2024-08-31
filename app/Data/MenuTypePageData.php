<?php

namespace App\Data;

use App\Models\MenuType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

class MenuTypePageData extends Data
{
    /** @var PaginatedDataCollection<MenuTypeData> */
    public PaginatedDataCollection $menuTypes;

    public function __construct()
    {
        $this->menuTypes = MenuTypeData::collect(
            MenuType::query()
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString()
        )->include('totalCategories', 'totalProducts');
    }
}