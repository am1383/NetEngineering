<?php

namespace App\Providers;

use App\Interfaces\Repositories\{
    CpuRepositoryInterface,
    GpuRepositoryInterface,
    ReservationRepositoryInterface,
    ServerCredentialRepositoryInterface,
    ServerRepositoryInterface,
    UserRepositoryInterface
};

use App\Models\{
    Cpu,
    Gpu,
    Reservation,
    Server,
    ServerCredential,
    User
};

use App\Repositories\{
    CpuRepository,
    GpuRepository,
    ReservationRepository,
    ServerCredentialRepository,
    ServerRepository,
    UserRepository
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, function ($app): UserRepository {
            return new UserRepository($app->make(User::class));
        });

        $this->app->singleton(ServerRepositoryInterface::class, function ($app): ServerRepository {
            return new ServerRepository($app->make(Server::class));
        });

        $this->app->singleton(ReservationRepositoryInterface::class, function ($app): ReservationRepository {
            return new ReservationRepository($app->make(Reservation::class));
        });

        $this->app->singleton(ServerCredentialRepositoryInterface::class, function ($app): ServerCredentialRepository {
            return new ServerCredentialRepository($app->make(ServerCredential::class));
        });

        $this->app->singleton(CpuRepositoryInterface::class, function ($app): CpuRepository {
            return new CpuRepository($app->make(Cpu::class));
        });

        $this->app->singleton(GpuRepositoryInterface::class, function ($app): GpuRepository {
            return new GpuRepository($app->make(Gpu::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
