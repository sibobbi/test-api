<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    const MAX_CATEGORY_LEVEL = 6;

    protected $fillable = ['sort_number', 'category_id'];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeParents($query)
    {
        return $query->where('category_id', null);
    }

    public function getCountExpand(): int
    {
        $depth = 0;
        $parent = $this->category;

        while ($parent) {
            $depth++;
            $parent = $parent->category;
        }

        return $depth + 1;
    }

    public function canMove(): bool
    {
        return $this->getCountExpand() < Category::MAX_CATEGORY_LEVEL;
    }

}
