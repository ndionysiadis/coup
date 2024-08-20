<?php

namespace App\Data;

use App\Models\Product;
use Spatie\LaravelData\Data;

/** @typescript */
class ProductData extends Data
{
    public function __construct(
        public int           $id,
        public int           $categoryId,
        public string        $name,

        public ?int          $price,
        public ?string       $image,
        public ?string       $description,
        public ?string       $createdAt,
        public ?string       $updatedAt,
        public ?string       $deletedAt,

        public ?CategoryData $category,
    )
    {
    }

    public static function fromModel(Product $product): self
    {
        return new self(
            id: $product->id,
            categoryId: $product->category_id,
            name: $product->name,
            price: $product->price,
            image: $product->image,
            description: $product->description,
            createdAt: $product->created_at,
            updatedAt: $product->updated_at,
            deletedAt: $product->deleted_at,
            category: CategoryData::fromModel($product->category),
        );
    }
}
