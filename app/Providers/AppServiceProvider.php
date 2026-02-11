<?php

namespace App\Providers;

use App\Exports\ReservationExport;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Interfaces\Services\CpuServiceInterface;
use App\Interfaces\Services\GpuServiceInterface;
use App\Interfaces\Services\HomeServiceInterface;
use App\Interfaces\Services\LoginServiceInterface;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Interfaces\Services\ServerCredentialServiceInterface;
use App\Interfaces\Services\ServerServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Services\CpuService;
use App\Services\GpuService;
use App\Services\HomeService;
use App\Services\LoginService;
use App\Services\ReservationService;
use App\Services\ServerCredentialService;
use App\Services\ServerService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(HomeServiceInterface::class, HomeService::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
        $this->app->bind(ServerCredentialServiceInterface::class, ServerCredentialService::class);
        $this->app->bind(ServerServiceInterface::class, ServerService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CpuServiceInterface::class, CpuService::class);
        $this->app->bind(GpuServiceInterface::class, GpuService::class);

        $this->app->bind(ReservationExport::class, function ($app): ReservationExport {
            return new ReservationExport(
                $app->make(ReservationRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
