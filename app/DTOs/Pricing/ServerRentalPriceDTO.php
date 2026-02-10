<?php

namespace App\DTOs\Pricing;

final class ServerRentalPriceDTO
{
    public function __construct(
        public readonly string $rentType,
        public readonly int $hours,
        public readonly int $pricePerHour,
        public readonly int $pricePerDay
    ) {}
}
