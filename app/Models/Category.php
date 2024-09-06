<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public $guarded = [];

    public function menuType(): BelongsTo
    {
        return $this->belongsTo(MenuType::class, 'menu_id');
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
