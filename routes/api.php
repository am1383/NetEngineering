<?php

use App\Http\Controllers\{
    AdminReservationController,
    LoginController,
    ReservationController,
    ServerBrowseController,
    ServerController
};

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);

    Route::middleware(['auth'])->group(function () {

        Route::get('/servers', [ServerBrowseController::class, 'index']);
        Route::post('/reserve', [ReservationController::class, 'store']);
        Route::get('/my-reservations', [ReservationController::class, 'myReservations']);

        Route::apiResource('/users', App\Http\Controllers\UserController::class)->only([
            'store',
            'edit',
            'update',
        ]);

        Route::middleware('role:admin')->group(function () {
            Route::prefix('/admin')->group(function () {
                Route::post('/servers', [ServerController::class, 'store']);
                Route::put('/servers/{server}', [ServerController::class, 'update']);
                Route::post('/reservations/{reservation}/credential', [AdminReservationController::class, 'setCredential']);
            });
        });
    });
});
