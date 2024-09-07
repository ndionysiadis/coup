<?php

namespace App\Data;

use App\Models\Product;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;

class ProductPageData extends Data
{
    /** @var PaginatedDataCollection<ProductData> */
    public PaginatedDataCollection $products;

    public function __construct()
    {
        $this->products = ProductData::collect(
            Product::query()
                ->orderBy('name')
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('category');
    }
}
