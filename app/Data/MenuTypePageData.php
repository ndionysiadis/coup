<?php

namespace App\Data;

use App\Models\MenuType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

class MenuTypePageData extends Data
{
    /** @var PaginatedDataCollection<MenuTypeData> */
    public PaginatedDataCollection $menuTypes;

    public string $term;

    public function __construct()
    {
        $this->menuTypes = MenuTypeData::collect(
            MenuType::query()
                ->search()
                ->orderBy('name')
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('totalCategories', 'totalProducts');

        $this->term = request('term') ?? '';
    }
}
