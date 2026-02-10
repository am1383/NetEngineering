<?php

namespace App\Providers;

use App\Interfaces\Repositories\CpuRepositoryInterface;
use App\Interfaces\Repositories\GpuRepositoryInterface;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Interfaces\Repositories\ServerCredentialRepositoryInterface;
use App\Interfaces\Repositories\ServerRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Reservation;
use App\Models\Server;
use App\Models\ServerCredential;
use App\Models\User;
use App\Repositories\CpuRepository;
use App\Repositories\GpuRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\ServerCredentialRepository;
use App\Repositories\ServerRepository;
use App\Repositories\UserRepository;
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
