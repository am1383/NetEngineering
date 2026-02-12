<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CpuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'brand' => $this->brand,
            'model' => $this->model,
            'cores' => $this->cores,
            'threads' => $this->threads,
            'base_clock' => $this->base_clock,
            'boost_clock' => $this->boost_clock,
        ];
    }
}
