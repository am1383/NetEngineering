<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'ip' => $this->ip,
            'rent_type' => $this->rent_type,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'username' => $this->whenLoaded('credential', function (): array {
                return [
                    'name' => $this->credential->username,
                ];
            }),
            'password' => $this->whenLoaded('credential', function (): array {
                return [
                    'password' => $this->credential->password,
                ];
            }),
        ];
    }
}
