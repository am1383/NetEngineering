<?php

namespace App\Services;

use App\DTOs\Pricing\ServerRentalPriceDTO;
use App\DTOs\Reservation\ServerReservationDTO;
use App\DTOs\Reservation\StoreReservationDTO;
use App\Enums\RentTypeEnum;
use App\Exceptions\ConfilictException;
use App\Helpers\TimeHelper;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Interfaces\Repositories\ServerCredentialRepositoryInterface;
use App\Interfaces\Repositories\ServerRepositoryInterface;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReservationService implements ReservationServiceInterface
{
    public function __construct(
        private readonly ServerRepositoryInterface $serverRepository,
        private readonly ReservationRepositoryInterface $reservationRepository,
        private readonly ServerCredentialRepositoryInterface $serverCredentialRepository
    ) {}

    public function storeReservation(StoreReservationDTO $dto): Reservation
    {
        $server = $this->serverRepository
            ->findOrFailByUuid($dto->serverUuid);

        $startTimestamp = TimeHelper::datetimeToTimestamp($dto->startTime);
        $endTimestamp = TimeHelper::datetimeToTimestamp($dto->endTime);

        $this->hasConflict($server->id, $startTimestamp, $endTimestamp);

        $hours = $this->getDurationInHours($startTimestamp, $endTimestamp);
        $price = $this->calculateRentalPrice(new ServerRentalPriceDTO(
            $dto->rentType,
            $hours,
            $server->price_per_hour,
            $server->price_per_day
        ));

        return $this->reserveServer(new ServerReservationDTO(
            $server->id,
            $startTimestamp,
            $endTimestamp,
            $dto->rentType,
            $price
        ));
    }

    private function hasConflict(int $serverId, int $startTime, int $endTime): void
    {
        $hasConflict = $this->reservationRepository
            ->hasConflict(
                $serverId,
                $startTime,
                $endTime
            );

        throw_if(
            $hasConflict,
            ConfilictException::class
        );
    }

    private function reserveServer(ServerReservationDTO $dto): Reservation
    {
        return DB::transaction(function () use ($dto): Reservation {
            return tap(
                $this->reservationRepository->store([
                    'user_id' => auth()->id(),
                    'server_id' => $dto->serverId,
                    'start_time' => $dto->startTime,
                    'end_time' => $dto->endTime,
                    'rent_type' => $dto->rentType,
                    'total_price' => $dto->price,
                ]),
                function (Reservation $reservation) {
                    $this->serverCredentialRepository->store([
                        'reservation_id' => $reservation->id,
                    ]);
                }
            );
        });
    }

    private function getDurationInHours(int $startTime, int $endTime): float
    {
        return Carbon::createFromTimestamp($startTime)
            ->diffInHours(Carbon::createFromTimestamp($endTime));
    }

    private function calculateRentalPrice(ServerRentalPriceDTO $dto): float
    {
        return $dto->rentType === RentTypeEnum::HOURLY_RENT
            ? $dto->hours * $dto->pricePerHour
            : ceil($dto->hours / Carbon::HOURS_PER_DAY) * $dto->pricePerDay;
    }

    public function getUserReservation(): Collection
    {
        return $this->reservationRepository
            ->getUserReservations();
    }
}
