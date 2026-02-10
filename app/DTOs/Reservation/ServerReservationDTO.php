<?php

namespace App\DTOs\Reservation;

final class ServerReservationDTO
{
    public function __construct(
        public readonly int $serverId,
        public readonly int $startTime,
        public readonly int $endTime,
        public readonly string $rentType,
        public readonly float $price,
    ) {}
}
