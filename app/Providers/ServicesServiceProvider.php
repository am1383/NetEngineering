<?php 
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Services\{
    CpuServiceInterface,
    GpuServiceInterface,
    HomeServiceInterface,
    LoginServiceInterface,
    ReservationServiceInterface,
    ReservationCredentialServiceInterface,
    ServerServiceInterface,
    UserServiceInterface
};

use App\Services\{
    CpuService,
    GpuService,
    HomeService,
    LoginService,
    ReservationService,
    ReservationCredentialService,
    ServerService,
    UserService
};

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * This provider is deferred.
     */
    protected $defer = true;

    /**
     * Register application service bindings.
     */
    public function register(): void
    {
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(HomeServiceInterface::class, HomeService::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
        $this->app->bind(ReservationCredentialServiceInterface::class, ReservationCredentialService::class);
        $this->app->bind(ServerServiceInterface::class, ServerService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CpuServiceInterface::class, CpuService::class);
        $this->app->bind(GpuServiceInterface::class, GpuService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Services provided by this deferred provider.
     */
    public function provides(): array
    {
        return [
            LoginServiceInterface::class,
            HomeServiceInterface::class,
            ReservationServiceInterface::class,
            ReservationCredentialServiceInterface::class,
            ServerServiceInterface::class,
            UserServiceInterface::class,
            CpuServiceInterface::class,
            GpuServiceInterface::class
        ];
    }
}
