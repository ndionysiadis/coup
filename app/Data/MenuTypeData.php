<?php

namespace App\Data;

use App\Models\MenuType;
use Spatie\LaravelData\Data;

/** @typescript */
class MenuTypeData extends Data
{
    public function __construct(
        public int     $id,
        public string  $name,
        public ?string $description,
        public ?string $createdAt,
        public ?string $updatedAt,
        public ?string $deletedAt,
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
        );
    }
}
