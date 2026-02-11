<?php

use App\Http\Controllers\CpuController;
use App\Http\Controllers\GpuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationExportController;
use App\Http\Controllers\ServerBrowseController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ServerCredentialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/status', HomeController::class);
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/gpus', [GpuController::class, 'index']);
    Route::get('/cpus', [CpuController::class, 'index']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/servers', [ServerBrowseController::class, 'index']);
        Route::post('/reserve', [ReservationController::class, 'store']);
        Route::get('/my-reservations', [ReservationController::class, 'show']);

        Route::apiResource('/users', UserController::class)->only([
            'store',
            'show',
            'update',
        ]);

        Route::middleware('admin')->group(function () {
            Route::prefix('/admin')->group(function () {
                Route::get('/export-reservations', ReservationExportController::class);
                Route::post('/servers', [ServerController::class, 'store']);
                Route::patch('/server/{server}', [ServerController::class, 'update']);
                Route::post('/reservation/{reservation}/credential', [ServerCredentialController::class, 'setCredential']);
            });
        });
    });
});
