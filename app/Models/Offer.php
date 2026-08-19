<?php

namespace App\Models;

use App\Enums\CreatedByType;
use App\Enums\DiscountType;
use App\Enums\OfferStatus;
use App\Enums\OfferType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brand_id',
        'category_id',
        'type',
        'title',
        'code',
        'redirect_url',
        'discount_type',
        'discount_value',
        'description',
        'terms_conditions',
        'starts_at',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => OfferType::class,
            'status' => OfferStatus::class,
            'discount_type' => DiscountType::class,
            'created_by_type' => CreatedByType::class,
            'discount_value' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_trending' => 'boolean',
            'starts_at' => 'date',
            'expires_at' => 'date',
            'verified_at' => 'datetime',
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function createdByAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by_admin_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'verified_by');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', OfferStatus::Approved);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', OfferStatus::Pending);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->approved()
            ->where(function (Builder $q) {
                $q->whereNull('starts_at')->orWhereDate('starts_at', '<=', now()->toDateString());
            })
            ->where(function (Builder $q) {
                $q->whereNull('expires_at')->orWhereDate('expires_at', '>=', now()->toDateString());
            });
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->approved()->whereDate('expires_at', '<', now()->toDateString());
    }

    public function scopeCoupons(Builder $query): Builder
    {
        return $query->where('type', OfferType::Coupon);
    }

    public function scopeDeals(Builder $query): Builder
    {
        return $query->where('type', OfferType::Deal);
    }
}