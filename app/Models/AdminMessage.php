<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminMessage extends Model
{
    protected $fillable = [
        'sender_admin_id',
        'receiver_admin_id',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'sender_admin_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'receiver_admin_id');
    }

    public function scopeUnreadFor(Builder $query, int $adminId): Builder
    {
        return $query->where('receiver_admin_id', $adminId)->whereNull('read_at');
    }
}
