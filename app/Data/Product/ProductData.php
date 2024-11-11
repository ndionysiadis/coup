<?php

namespace App\Data\Product;

use App\Data\Category\CategoryData;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\WithoutValidation;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

/** @typescript */
class ProductData extends Data
{
    public function __construct(
        public ?int                              $id,
        public ?int                              $order,

        #[WithoutValidation]
        public Optional|int|null                 $categoryId,

        public string                            $name,

        public string                            $price,
        #[WithoutValidation]
        public UploadedFile|Optional|string|null $image,
        public ?string                           $description,
        public ?string                           $createdAt,
        public ?string                           $updatedAt,
        public ?string                           $deletedAt,

        public Lazy|CategoryData|null            $category,
    )
    {
    }

    public static function fromModel(Product $product): self
    {
        return new self(
            id: $product->id,
            order: $product->order,
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
            'price' => '',
            'category' => '',
            'image' => null,
        ];
    }

    public static function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
            'category' => 'nullable',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:10240',
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'Το πεδίο Όνομα είναι υποχρεωτικό',
            'price.required' => 'Το πεδίο Τιμή είναι υποχρεωτικό',
            'image.file' => 'Το πεδίο Εικόνα πρέπει να είναι αρχείο',
            'image.mimes' => 'Η εικόνα πρέπει να είναι τύπου: jpg, jpeg, png, gif',
            'image.max' => 'Η εικόνα δεν πρέπει να ξεπερνά τα 10MB',
        ];
    }

    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category?->id,
            'image' => $this->image
        ];
    }
}
