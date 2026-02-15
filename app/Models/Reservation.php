<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id', 'server_id', 'start_time',
        'end_time', 'rent_type', 'total_price', 'status',
    ];

    protected $with = ['credential'];

    protected static function booted(): void
    {
        static::creating(function (Model $model): void {
            $model->uuid = Str::uuid();
        });

        static::creating(function (Model $model): void {
            $model->ip = fake()->ipv4();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }

    public function credential(): HasOne
    {
        return $this->hasOne(ServerCredential::class, 'reservation_id');
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->where('status', StatusEnum::PAID);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
