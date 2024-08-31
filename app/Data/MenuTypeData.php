<?php

namespace App\Data;

use App\Models\MenuType;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class MenuTypeData extends Data
{
    public function __construct(
        public ?int                            $id,
        public string                          $name,
        public ?string                         $description,
        public ?string                         $createdAt,
        public ?string                         $updatedAt,
        public ?string                         $deletedAt,

        public Lazy|int|Optional               $totalCategories,
        public Lazy|int|Optional               $totalProducts,

        /** @var Optional|Lazy|DataCollection<CategoryData> */
        public Lazy|CategoryData|Optional|null $categories,


    )
    {
    }

    public static function fromModel(MenuType $menuType): self
    {
        return new self(
            id: $menuType->id,
            name: $menuType->name,
            description: $menuType->description,
            createdAt: $menuType->created_at,
            updatedAt: $menuType->updated_at,
            deletedAt: $menuType->deleted_at,
            totalCategories: Lazy::create(fn() => $menuType->categories()->count()),
            totalProducts: Lazy::create(fn() => $menuType->categories->sum(fn($category) => $category->products()->count())),
            categories: Lazy::create(fn() => CategoryData::collect($menuType->categories)),
        );
    }

}
