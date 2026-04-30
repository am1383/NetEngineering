<?php 
declare(strict_types=1);

namespace App\DTOs\Pricing;

final class ServerRentalPriceDTO
{
    public function __construct(
        public readonly string $rentType,
        public readonly float $hours,
        public readonly int $pricePerHour,
        public readonly int $pricePerDay
    ) {}
}
