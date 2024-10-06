<?php

namespace App\Data\Menu;

use App\Data\Category\CategoryData;
use App\Models\MenuType;
use Spatie\LaravelData\Concerns\EmptyData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

/** @typescript */
class MenuTypeData extends Data
{
    use EmptyData;

    public function __construct(
        public ?int                              $id,
        public ?int                              $order,
        public string                            $name,
        public ?string                           $description,
        public ?string                           $createdAt,
        public ?string                           $updatedAt,
        public ?string                           $deletedAt,

        public Lazy|int|Optional                 $totalCategories,
        public Lazy|int|Optional                 $totalProducts,

        /** @var Optional|Lazy|DataCollection<CategoryData> */
        public Lazy|DataCollection|Optional|null $categories,

    )
    {
    }

    public static function fromModel(MenuType $menuType): self
    {
        return new self(
            id: $menuType->id,
            order: $menuType->order,
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

    public static function empty(array $extra = []): array
    {
        return [
            'name' => '',
            'description' => '',
            'categories' => []
        ];
    }

    public static function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'categories' => 'nullable',
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'Το πεδίο Όνομα είναι υποχρεωτικό',
        ];
    }


}
