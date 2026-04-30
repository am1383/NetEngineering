<?php 
declare(strict_types=1);

namespace App\Exports;

use App\Interfaces\Repositories\ReservationRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservationExport implements FromQuery, WithHeadings
{
    public function __construct(
        private readonly ReservationRepositoryInterface $reservationRepository
    ) {}

    public function query(): Builder
    {
        return $this->reservationRepository
            ->fetchReservationExport();
    }

    public function headings(): array
    {
        return ['username', 'name', 'start_time',
            'end_time', 'rent_type', 'total_price', 'status',
        ];
    }
}
