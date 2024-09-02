<?php

namespace App\Data;

use App\Models\Category;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

/** @typescript */
class CategoryData extends Data
{
    public function __construct(
        public int                   $id,
        public int                   $menuId,
        public int                   $totalProducts,
        public string                $name,

        public ?string               $description,
        public ?string               $createdAt,
        public ?string               $updatedAt,
        public ?string               $deletedAt,

        /** @var Optional|Lazy|DataCollection<ProductData> */
        public Lazy|DataCollection|Optional|null $products,
    )
    {
    }

    public static function fromModel(Category $category): self
    {
        return new self(
            id: $category->id,
            menuId: $category->menu_id,
            totalProducts: $category->products()->count(),
            name: $category->name,
            description: $category->description,
            createdAt: $category->created_at,
            updatedAt: $category->updated_at,
            deletedAt: $category->deleted_at,
            products: Lazy::create(fn() => ProductData::collect($category->products))
        );
    }
}
