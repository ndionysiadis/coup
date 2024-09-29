<?php

namespace App\Data\Category;

use App\Models\Category;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

class CategoryIndexPageData extends Data
{
    /** @var PaginatedDataCollection<CategoryData> */
    public PaginatedDataCollection $categories;

    public string $term;
    public function __construct()
    {
        $this->categories = CategoryData::collect(
            Category::query()
                ->searchIndex()
                ->orderBy('name')
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('menuType', 'products');

        $this->term = request('term') ?? '';
    }
}
