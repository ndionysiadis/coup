<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeSearchIndex(Builder $query): void
    {
        $query
            ->when(request('term') ?? null, function ($query, $term) {
                $term = strtolower($term); // Ensure case-insensitive search
                $query->where(function ($query) use ($term) {
                    $query
                        ->whereRaw("LOWER(name) like '%" . $term . "%'")
                        ->orWhereRaw("LOWER(description) like '%" . $term . "%'")
                        ->orWhere('price', 'like', '%' . $term . '%')
                        ->orWhereHas('category', function ($categoryQuery) use ($term) {
                            $categoryQuery->whereRaw("LOWER(name) like '%" . $term . "%'");
                        });
                });
            });
    }
    public function scopeSearchShow(Builder $query): void
    {
        $query->when(request('term') ?? null, function ($query, $term) {
            $query->whereRaw("LOWER(name) like '%" . strtolower($term) . "%'");
        });
    }
}
