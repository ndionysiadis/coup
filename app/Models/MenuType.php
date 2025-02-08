<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuType extends Model
{
    use SoftDeletes;

    public $guarded = [];
    protected $fillable = [
        'name',
        'description',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'menu_id');
    }

    public function scopeSearchIndex(Builder $query): void
    {
        $query
            ->when(request('term') ?? null, function ($query, $term) {
                $query->where(function ($query) use ($term) {
                    $query
                        ->whereRaw("LOWER(name) like '%" . $term . "%'")
                        ->orWhereRaw("LOWER(description) like '%" . $term . "%'");
                });
            });
    }
}

