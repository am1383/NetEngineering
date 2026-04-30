<?php 
declare(strict_types=1);

namespace App\DTOs\Reservation;

final class StoreReservationDTO
{
    public function __construct(
        public readonly string $serverUlid,
        public readonly string $startTime,
        public readonly string $endTime,
        public readonly string $rentType,
    ) {}
}
