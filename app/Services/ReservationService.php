<?php 
declare(strict_types=1);

namespace App\Services;

use App\DTOs\Pricing\ServerRentalPriceDTO;

use App\DTOs\Reservation\{
    ServerReservationDTO,
    StoreReservationDTO,
};

use App\Enums\RentType;
use App\Exceptions\ConfilictException;
use App\Helpers\TimeHelper;

use App\Interfaces\Repositories\{
    ReservationRepositoryInterface,
    ServerCredentialRepositoryInterface,
    ServerRepositoryInterface
};

use App\Interfaces\Services\ReservationServiceInterface;

use App\Models\{
    Reservation,
    Server
};

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
            ->findOrFailByUlid($dto->serverUlid, [
                'id', 'price_per_day', 'price_per_hour'
            ]);

        $startTimestamp = TimeHelper::datetimeToTimestamp($dto->startTime);
        $endTimestamp = TimeHelper::datetimeToTimestamp($dto->endTime);

        $this->hasConflict($server->id, $startTimestamp, $endTimestamp);

        $durationHours = $this->getDurationInHours($startTimestamp, $endTimestamp);
        $rentalPrice = $this->calculateRentalPrice(new ServerRentalPriceDTO(
            $dto->rentType,
            $durationHours,
            $server->price_per_hour,
            $server->price_per_day
        ));

        return $this->reserveServer(new ServerReservationDTO(
            $server->id,
            $startTimestamp,
            $endTimestamp,
            $dto->rentType,
            $rentalPrice
        ));
    }

    private function hasConflict(int $serverId, int $startTime, int $endTime): void
    {
        throw_if($this->reservationRepository->hasConflict(
            $serverId, $startTime, $endTime
            ), ConfilictException::class
        );
    }

    private function reserveServer(ServerReservationDTO $dto): Reservation
    {
        return DB::transaction(function () use ($dto): Reservation {
            return tap(
                $this->reservationRepository->create([
                    'user_id' => auth()->id(),
                    'server_id' => $dto->serverId,
                    'start_time' => $dto->startTime,
                    'end_time' => $dto->endTime,
                    'rent_type' => $dto->rentType,
                    'total_price' => $dto->price,
                ]), function (Reservation $reservation): void {
                    $this->serverCredentialRepository->create([
                        'reservation_id' => $reservation->id,
                ]);
            });
        });
    }

    private function getDurationInHours(int $startTime, int $endTime): float
    {
        return Carbon::createFromTimestamp($startTime)
            ->diffInHours(Carbon::createFromTimestamp($endTime));
    }

    private function calculateRentalPrice(ServerRentalPriceDTO $dto): float
    {
        return $dto->rentType === RentType::HOURLY_RENT->value
            ? $dto->hours * $dto->pricePerHour
            : ceil($dto->hours / Carbon::HOURS_PER_DAY) * $dto->pricePerDay;
    }

    public function getUserReserveWithoutCredential(): Collection
    {
        return $this->reservationRepository
            ->fetchUserReserveWithoutCredential();
    }

    public function getUserReservation(): Collection
    {
        return $this->reservationRepository
            ->fetchUserReservations(auth()->user());
    }

    public function getServerReservationsTime(Server $server): Collection
    {
        $reservations = $this->reservationRepository
            ->fetchServerReservations($server);

        return $this->mergeUnavailableRanges($reservations);
    }

    private function mergeUnavailableRanges(Collection $reservations): Collection
    {
        return $reservations->reduce(
            function (Collection $carry, Reservation $reservation): Collection {
                $startTime = Carbon::createFromTimestamp($reservation->start_time);
                $endTime = Carbon::createFromTimestamp($reservation->end_time);

                if ($carry->isEmpty()) {
                    return $carry->push([
                        'start_datetime' => $startTime->toDateTimeString(),
                        'end_datetime' => $endTime->toDateTimeString(),
                    ]);
                }

                $lastIndex = $this->getLastItemIndex($carry->count());
                $last = $carry->get($lastIndex);
                $lastEnd = Carbon::parse($last['end_datetime']);

                if ($startTime->lte($lastEnd)) {
                    $last['end_datetime'] = max(
                        $endTime->toDateTimeString(),
                        $last['end_datetime']
                    );

                    $carry->put($lastIndex, $last);
                } else {
                    $carry->push([
                        'start_datetime' => $startTime->toDateTimeString(),
                        'end_datetime' => $endTime->toDateTimeString(),
                    ]);
                }

                return $carry;
            },
            collect()
        )->values();
    }

    private function getLastItemIndex(int $itemsCount): int
    {
        return $itemsCount - 1;
    }
}
