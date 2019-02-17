<?php
namespace App\Providers;

use App\Domain\Booking\BookingRepository;
use App\Domain\Client\ClientRepository;
use App\Domain\Ship\ShipRepository;
use App\Domain\Attachment\AttachmentRepository;
use App\Domain\BackendUser\BackendUserRepository;
use App\Infrastructure\Eloquent\BookingRepositoryEloquent;
use App\Infrastructure\Eloquent\ClientRepositoryEloquent;
use App\Infrastructure\Eloquent\ShipRepositoryEloquent;
use App\Infrastructure\Eloquent\AttachmentRepositoryEloquent;
use App\Infrastructure\Eloquent\BackendUserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BackendUserRepository::class, BackendUserRepositoryEloquent::class);
        $this->app->singleton(ShipRepository::class, ShipRepositoryEloquent::class);
        $this->app->singleton(ClientRepository::class, ClientRepositoryEloquent::class);
        $this->app->singleton(BookingRepository::class, BookingRepositoryEloquent::class);
        $this->app->singleton(AttachmentRepository::class, AttachmentRepositoryEloquent::class);
    }
}

