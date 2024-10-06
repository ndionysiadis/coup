<?php

namespace App\Data\Category;

use App\Data\Menu\MenuTypeData;
use App\Data\Product\ProductData;
use App\Models\Category;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

/** @typescript */
class CategoryData extends Data
{
    public function __construct(
        public ?int                              $id,
        public ?int                              $menuId,
        public ?int                              $totalProducts,
        public ?int                              $order,
        public string                            $name,

        public ?string                           $description,
        public ?string                           $createdAt,
        public ?string                           $updatedAt,
        public ?string                           $deletedAt,

        /** @var Optional|Lazy|DataCollection<ProductData> */
        public Lazy|DataCollection|Optional|null $products,

        public Lazy|MenuTypeData|null            $menuType,
    )
    {
    }

    public static function fromModel(Category $category): self
    {
        return new self(
            id: $category->id,
            menuId: $category->menu_id,
            totalProducts: $category->products()->count(),
            order: $category->order,
            name: $category->name,
            description: $category->description,
            createdAt: $category->created_at,
            updatedAt: $category->updated_at,
            deletedAt: $category->deleted_at,
            products: Lazy::create(fn() => ProductData::collect($category->products)),
            menuType: Lazy::create(fn() => MenuTypeData::optional($category->menuType))
        );
    }

    public static function empty(array $extra = []): array
    {
        return [
            'name' => '',
            'description' => '',
            'products' => [],
            'menuType' => ''
        ];
    }

    public static function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'products' => 'nullable',
            'menuType' => 'nullable'
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'Το πεδίο Όνομα είναι υποχρεωτικό',
        ];
    }
}
