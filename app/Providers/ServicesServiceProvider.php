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

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        LoginServiceInterface::class => LoginService::class,
        HomeServiceInterface::class => HomeService::class,
        ReservationServiceInterface::class => ReservationService::class,
        ReservationCredentialServiceInterface::class => ReservationCredentialService::class,
        ServerServiceInterface::class => ServerService::class,
        UserServiceInterface::class => UserService::class,
        CpuServiceInterface::class => CpuService::class,
        GpuServiceInterface::class => GpuService::class
    ];

    /**
     * Register application service bindings.
     */
    public function register(): void
    {
        //
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
