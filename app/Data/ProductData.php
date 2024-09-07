<?php

namespace App\Data;

use App\Models\Product;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

/** @typescript */
class ProductData extends Data
{
    public function __construct(
        public ?int                              $id,
        public ?int                              $categoryId,
        public string                            $name,

        public ?int                              $price,
        public ?string                           $image,
        public ?string                           $description,
        public ?string                           $createdAt,
        public ?string                           $updatedAt,
        public ?string                           $deletedAt,

        /** @var Optional|Lazy|DataCollection<CategoryData> */
        public Lazy|DataCollection|Optional|null $category,
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
            category: Lazy::create(fn() => CategoryData::optional($product->category))
        );
    }

    public static function empty(array $extra = []): array
    {
        return [
            'name' => '',
            'description' => '',
            'price' => ''
        ];
    }

    public static function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'price' => ['nullable'],
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'Το πεδίο Όνομα είναι υποχρεωτικό',
        ];
    }

    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ];
    }
}
