<?php

namespace App\Data;

use App\Models\Category;
use Spatie\LaravelData\Data;

/** @typescript */
class CategoryData extends Data
{
    public function __construct(
        public int          $id,
        public int          $menuId,
        public string       $name,

        public ?string      $description,
        public ?string      $createdAt,
        public ?string      $updatedAt,
        public ?string      $deletedAt,

        public MenuTypeData $menuType,
        public ?ProductData $products,
    )
    {
    }

    public function fromModel(Category $category): self
    {
        return new self(
            id: $category->id,
            menuId: $category->menu_id,
            name: $category->name,
            description: $category->description,
            createdAt: $category->created_at,
            updatedAt: $category->updated_at,
            deletedAt: $category->deleted_at,
            menuType: MenuTypeData::fromModel($category->menuType),
            products: ProductData::fromModel($category->products),
        );
    }

}
