<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeSearch(Builder $query): void
    {
        $query
            ->when(request('term') ?? null, function ($query, $term) {
                $query->where(function ($query) use ($term) {
                    $query
                        ->whereRaw("LOWER(name) like '%" . $term . "%'")
                        ->orWhereHas('menuType', function ($menuTypeQuery) use ($term) {
                            $menuTypeQuery->whereRaw("LOWER(name) like '%" . $term . "%'");
                        });
                });
            });
    }
}
