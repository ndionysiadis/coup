<?php

namespace App\Data\Product;

use App\Models\Product;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

/** @typescript */
class ProductPageData extends Data
{
    /** @var PaginatedDataCollection<ProductData> */
    public PaginatedDataCollection $products;
    public string $term;

    public function __construct()
    {
        $this->products = ProductData::collect(
            Product::query()
                ->searchIndex()
                ->orderBy('name')
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('category');

        $this->term = request('term') ?? '';
    }
}