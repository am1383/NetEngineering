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

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, function (Container $app): UserRepository {
            return new UserRepository($app->make(User::class));
        });

        $this->app->singleton(ServerRepositoryInterface::class, function (Container $app): ServerRepository {
            return new ServerRepository($app->make(Server::class));
        });

        $this->app->singleton(ReservationRepositoryInterface::class, function (Container $app): ReservationRepository {
            return new ReservationRepository($app->make(Reservation::class));
        });

        $this->app->singleton(ServerCredentialRepositoryInterface::class, function (Container $app): ServerCredentialRepository {
            return new ServerCredentialRepository($app->make(ServerCredential::class));
        });

        $this->app->singleton(CpuRepositoryInterface::class, function (Container $app): CpuRepository {
            return new CpuRepository($app->make(Cpu::class));
        });

        $this->app->singleton(GpuRepositoryInterface::class, function (Container $app): GpuRepository {
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
