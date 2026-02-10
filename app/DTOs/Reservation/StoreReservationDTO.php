<?php

namespace App\DTOs\Reservation;

final class StoreReservationDTO
{
    public function __construct(
        public readonly string $serverUuid,
        public readonly string $startTime,
        public readonly string $endTime,
        public readonly string $rentType,
    ) {}
}
