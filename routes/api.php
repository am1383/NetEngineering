<?php

use App\Http\Controllers\{
    CpuController,
    GpuController,
    HomeController,
    LoginController,
    ProfileController,
    RegisterController,
    ReservationController,
    ReservationExportController,
    ServerBrowseController,
    ServerController,
    ServerCredentialController,
    UserController
};

use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('/login', [LoginController::class, 'login'])
            ->name('login');
        Route::post('/register', RegisterController::class)
            ->name('register');

        Route::get('/servers/{server}/unavailable', [ServerController::class, 'unavailable'])
            ->name('servers.unavailable');
        Route::get('/status', HomeController::class)
            ->name('home.status');
        Route::get('/gpus', [GpuController::class, 'index'])
            ->name('gpus.index');
        Route::get('/cpus', [CpuController::class, 'index'])
            ->name('cpus.index');

        Route::middleware('auth:api')->group(function () {
            Route::get('/servers', [ServerBrowseController::class, 'index'])
                ->name('servers.index');
            Route::get('/reservations/without-credential', [ReservationController::class, 'withoutCredential'])
                ->name('credential.without');
            Route::get('/my-reservations', [ReservationController::class, 'show'])
                ->name('reservations.show');
            Route::post('/reserves', [ReservationController::class, 'store'])
                ->name('reserves.store');

            Route::controller(UserController::class)->group(function () {
                Route::post('/users', [UserController::class, 'store'])
                    ->name('users.store');
                Route::match(['PUT', 'PATCH'], '/profile', [ProfileController::class, 'update'])
                    ->name('profile.update');
                Route::get('/profile', [ProfileController::class, 'show'])
                    ->name('profile.show');
            });

            Route::middleware('admin')->group(function () {
                Route::prefix('/admin')->group(function () {
                    Route::get('/export-reservations', ReservationExportController::class)
                        ->name('reservations.export');
                    Route::controller(ServerController::class)->group(function () {
                        Route::post('/servers', 'store')
                            ->name('servers.store');
                        Route::patch('/servers/{server}', 'update')
                            ->name('servers.update');
                    });
                    Route::put('/reservations/{reservation}/credential', [ServerCredentialController::class, 'setCredential'])
                        ->name('server-credentials.put');
                });
            });
        });
    });
});
