<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuType extends Model
{
    use SoftDeletes;

    public $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'menu_id');
    }
}

