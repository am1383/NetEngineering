<?php

namespace App\Providers;

use App\Exports\ReservationExport;

use App\Interfaces\Repositories\{
    ReservationRepositoryInterface
};

use App\Interfaces\Services\{
    CpuServiceInterface,
    GpuServiceInterface,
    HomeServiceInterface,
    LoginServiceInterface,
    ReservationServiceInterface,
    ServerCredentialServiceInterface,
    ServerServiceInterface,
    UserServiceInterface
};

use App\Services\{
    CpuService,
    GpuService,
    HomeService,
    LoginService,
    ReservationService,
    ServerCredentialService,
    ServerService,
    UserService
};

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
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

        $this->app->bind(ReservationExport::class, function (Container $app): ReservationExport {
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
