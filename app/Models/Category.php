<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'is_trending',
        'parent_id',
    ];

    protected function casts(): array
    {
        return [
            'is_trending' => 'boolean',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}