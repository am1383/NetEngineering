<?php 
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ulid,
            'name' => $this->name,
            
            'cpu' => $this->whenLoaded('cpu', function (): array {
                return [
                    'name' => $this->cpu->model
                ];
            }),

            'gpu' => $this->whenLoaded('gpu', function (): array {
                return [
                    'name' => $this->gpu->model
                ];
            }),

            'ram' => $this->whenLoaded('ram', function (): array {
                return [
                    'name' => $this->ram->model
                ];
            }),

            'storage' => $this->storage,
            'os' => $this->os,
            'is_active' => $this->is_active,
            'price_per_hour' => $this->price_per_hour,
            'price_per_day' => $this->price_per_day
        ];
    }
}
