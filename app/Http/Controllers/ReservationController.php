<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ReservationServiceInterface;
use Illuminate\Http\Request;

class ReservationController
{
    public function __construct(private ReservationServiceInterface $reservationService) {}

    public function store(Request $request)
    {
        
    }

    public function show()
    {
        return auth()->user()->reservations()
            ->with(['server', 'credential'])->get();
    }
}
