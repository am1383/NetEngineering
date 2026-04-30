<?php 
declare(strict_types=1); 

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
     * This provider is deferred.
     */
    protected $defer = true;

    /**
     * Register application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, fn (Container $app): UserRepository
            => new UserRepository($app->make(User::class))
        );

        $this->app->singleton(ServerRepositoryInterface::class, fn (Container $app): ServerRepository 
            => new ServerRepository($app->make(Server::class))
        );

        $this->app->singleton(ReservationRepositoryInterface::class, fn (Container $app): ReservationRepository 
            => new ReservationRepository($app->make(Reservation::class))
        );

        $this->app->singleton(ServerCredentialRepositoryInterface::class, fn (Container $app): ServerCredentialRepository 
            => new ServerCredentialRepository($app->make(ServerCredential::class))
        );

        $this->app->singleton(CpuRepositoryInterface::class, fn (Container $app): CpuRepository 
            => new CpuRepository($app->make(Cpu::class))
        );

        $this->app->singleton(GpuRepositoryInterface::class, fn (Container $app): GpuRepository 
            => new GpuRepository($app->make(Gpu::class))
        );
    }

    /**
     * Services provided by this provider.
     */
    public function provides(): array
    {
        return [
            UserRepositoryInterface::class,
            ServerRepositoryInterface::class,
            ReservationRepositoryInterface::class,
            ServerCredentialRepositoryInterface::class,
            CpuRepositoryInterface::class,
            GpuRepositoryInterface::class,
        ];
    }
}
