<?php

use App\Http\Controllers\{
    CpuController,
    GpuController,
    HomeController,
    LoginController,
    RegisterController,
    ReservationController,
    ReservationExportController,
    ServerBrowseController,
    ServerController,
    ServerCredentialController,
    UserController
};

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login');
    Route::post('/register', RegisterController::class)
        ->name('register');

    Route::get('/servers/{server}/unavailable', [ServerController::class, 'unavailable'])
        ->name('unavailabe.server');
    Route::get('/status', HomeController::class)
        ->name('home.status');
    Route::get('/gpus', [GpuController::class, 'index'])
        ->name('index.gpu');
    Route::get('/cpus', [CpuController::class, 'index'])
        ->name('index.cpu');

    Route::middleware('auth:api')->group(function () {
        Route::get('/servers', [ServerBrowseController::class, 'index'])
            ->name('index.server');
        Route::get('/reservation/without-credential', [ReservationController::class, 'withoutCredential'])
            ->name('without.credential');
        Route::get('/my-reservations', [ReservationController::class, 'show'])
            ->name('show.reservation');
        Route::post('/reserves', [ReservationController::class, 'store'])
            ->name('store.reserve');

        Route::controller(UserController::class)->group(function () {
            Route::post('/users', [UserController::class, 'store'])
                ->name('store.user');
            Route::match(['PUT', 'PATCH'], '/user/profile', [UserController::class, 'update'])
                ->name('profile.update');
            Route::get('/user/profile', [UserController::class, 'show'])
                ->name('profile.show');
        });

        Route::middleware('admin')->group(function () {
            Route::prefix('/admin')->group(function () {
                Route::get('/export-reservations', ReservationExportController::class)
                    ->name('export.reservation');
                Route::controller(ServerController::class)->group(function () {
                    Route::post('/servers', 'store')
                        ->name('store.server');
                    Route::patch('/servers/{server}', 'update')
                        ->name('update.server');
                });
                Route::put('/reservations/{reservation}/credential', [ServerCredentialController::class, 'setCredential'])
                    ->name('put.server.credential');
            });
        });
    });
});
