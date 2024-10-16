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

    public function __construct(bool $withTrashed = false)
    {
        $query = Product::query()
            ->searchIndex()
            ->orderBy('order');

        if ($withTrashed) {
            $query->onlyTrashed();
        }

        $this->products = ProductData::collect(
               $query
                ->paginate(20)
                ->withQueryString(),
            PaginatedDataCollection::class
        )->include('category');

        $this->term = request('term') ?? '';
    }
}
