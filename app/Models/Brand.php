<?php

namespace App\Models;

use App\Enums\BrandStatus;
use App\Models\Concerns\HasEmailVerificationCodes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Brand extends Authenticatable
{
    use Notifiable, SoftDeletes, HasEmailVerificationCodes;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'small_logo',
        'large_logo',
        'website_url',
        'social_links',
        'short_description',
        'about_description',
        'category_id',
        'allow_admin_to_add_offers',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'status' => BrandStatus::class,
            'social_links' => 'array',
            'allow_admin_to_add_offers' => 'boolean',
            'auto_publish_offers' => 'boolean',
            'verified_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'verified_by');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function isVerified(): bool
    {
        return $this->status === BrandStatus::Verified;
    }
}