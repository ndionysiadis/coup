<?php

namespace App\Repositories;

use App\Data\MenuTypeData;
use App\Models\MenuType;

class MenuRepository
{
    public function __construct(public MenuType $menuType)
    {
    }
    public function update(MenuTypeData $request): void
    {
        $this->menuType->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    }
    public function delete(): void
    {
        $this->menuType->delete();
    }
}
