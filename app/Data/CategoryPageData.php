<?php

namespace App\Data;

use App\Models\Category;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

class CategoryPageData extends Data
{
    /** @var PaginatedDataCollection<CategoryData> */
    public PaginatedDataCollection $categories;

    public function __construct()
    {
        $this->categories = CategoryData::collect(
            Category::query()
                ->orderBy('name')
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('menuType', 'products');
    }
}
