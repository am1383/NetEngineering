<?php

namespace App\Providers;

use App\Interfaces\Repositories\{
    ServerCredentialRepositoryInterface,
    ReservationRepositoryInterface,
    ServerRepositoryInterface,
    UserRepositoryInterface,
};

use App\Interfaces\Services\{
    LoginServiceInterface,
    ReservationServiceInterface,
    ServerServiceInterface,
    UserServiceInterface,
};

use App\Repositories\{
    ServerCredentialRepository,
    ReservationRepository,
    ServerRepository,
    UserRepository
};

use App\Services\{
    LoginService,
    ReservationService,
    ServerService,
    UserService
};

use Illuminate\Support\ServiceProvider;

use App\Models\{
    Reservation,
    ServerCredential,
    Server,
    User
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
        $this->app->bind(ServerServiceInterface::class, ServerService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
