<?php

namespace App\Http\Controllers;

use App\Exports\ReservationExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReservationExportController
{
    public function __invoke(): BinaryFileResponse
    {
        return Excel::download(app(ReservationExport::class),
            'reservations.xlsx');
    }
}
