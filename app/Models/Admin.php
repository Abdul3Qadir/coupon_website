<?php

namespace App\Models;

use App\Enums\AdminRole;
use App\Enums\AdminStatus;
use App\Models\Concerns\HasEmailVerificationCodes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes, HasEmailVerificationCodes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'role' => AdminRole::class,
            'status' => AdminStatus::class,
            'auto_publish_offers' => 'boolean',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function subAdmins(): HasMany
    {
        return $this->hasMany(Admin::class, 'created_by');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'created_by_admin_id');
    }

    public function verifiedOffers(): HasMany
    {
        return $this->hasMany(Offer::class, 'verified_by');
    }

    public function verifiedBrands(): HasMany
    {
        return $this->hasMany(Brand::class, 'verified_by');
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === AdminRole::SuperAdmin;
    }
}