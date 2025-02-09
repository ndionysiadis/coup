<?php

namespace App\Data\Category;

use App\Models\Category;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

/** @typescript */
class CategoryIndexPageData extends Data
{
    /** @var PaginatedDataCollection<CategoryData> */
    public PaginatedDataCollection $categories;

    public string $term;

    public function __construct(bool $withTrashed = false)
    {

        $query = Category::query()
            ->searchIndex()
            ->orderBy('order');

        if ($withTrashed) {
            $query->onlyTrashed();
        }

        $this->categories = CategoryData::collect(
            $query
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('menuType', 'products');

        $this->term = request('term') ?? '';
    }
}
