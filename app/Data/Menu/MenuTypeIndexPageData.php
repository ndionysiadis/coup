<?php

namespace App\Data\Menu;

use App\Models\MenuType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

/** @typescript */
class MenuTypeIndexPageData extends Data
{
    /** @var PaginatedDataCollection<MenuTypeData> */
    public PaginatedDataCollection $menuTypes;

    public string $term;

    public function __construct(bool $withTrashed = false)
    {
        $query = MenuType::query()->searchIndex()->orderBy('name');

        if ($withTrashed) {
            $query->onlyTrashed();
        }

        $this->menuTypes = MenuTypeData::collect(
            $query
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('totalCategories', 'totalProducts');

        $this->term = request('term') ?? '';
    }
}
