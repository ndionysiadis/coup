<?php

namespace App\Data\Category;

use App\Data\Product\ProductData;
use App\Models\Category;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

/** @typescript */
class CategoryShowPageData extends Data
{
    public CategoryData $category;

    /** @var PaginatedDataCollection<ProductData> */
    public PaginatedDataCollection $products;

    public string $term;

    public function __construct(Category $category)
    {
        $this->category = CategoryData::from($category)
            ->include('menuType');

        $this->products = ProductData::collect(
            $category->products()
                ->searchShow()
                ->orderBy('name')
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        );

        $this->term = request('term') ?? '';
    }
}
