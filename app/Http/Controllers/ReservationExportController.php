<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exports\ReservationExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReservationExportController
{
    public function __invoke(ReservationExport $export): BinaryFileResponse
    {
        return Excel::download($export, 'reservations.xlsx');
    }
}
