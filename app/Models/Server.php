<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Server extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cpu_id', 'gpu_id', 'ram_id', 'storage', 'os',
        'price_per_hour', 'price_per_day', 'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($model): void {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function cpu(): BelongsTo
    {
        return $this->belongsTo(Cpu::class);
    }

    public function gpu(): BelongsTo
    {
        return $this->belongsTo(Gpu::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
