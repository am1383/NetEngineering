<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Server;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'server_id', 'start_time',
        'end_time', 'rent_type', 'total_price', 'status',
    ];

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }

    public function credential(): HasOne
    {
        return $this->hasOne(ServerCredential::class);
    }
}
