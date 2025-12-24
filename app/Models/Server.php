<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;

class Server extends Model
{
    protected $fillable = [
        'cpu', 'gpu', 'ram', 'storage', 'os',
        'price_per_hour', 'price_per_day', 'is_active',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeActive(Builder$query): Builder
    {
        return $query->where('is_active', true);
    }
}
