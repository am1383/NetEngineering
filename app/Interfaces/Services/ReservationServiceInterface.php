<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\DTOs\Reservation\CreateReservationDTO;
use App\Models\Server;
use Illuminate\Support\Collection;

interface ReservationServiceInterface
{
    public function createReservation(CreateReservationDTO $dto): void;

    public function getUserReservationsWithoutCredential(): Collection;

    public function getServerReservationsTime(Server $server): Collection;

    public function getUserReservations(): Collection;
}
