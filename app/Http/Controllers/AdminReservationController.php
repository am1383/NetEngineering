<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class AdminReservationController
{
    public function setCredential(Request $request, Reservation $reservation)
    {
        $reservation->credential()->update([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        return response()->json(['message' => 'Credentials set']);
    }
}

