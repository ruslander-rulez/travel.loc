<?php

namespace App\Providers;

use App\Application\Auth\PasswordHasher;
use App\Domain\Core\GeoService;
use App\Domain\Core\OrdersAdminSDK;
use App\Infrastructure\Service\AppGeoService;
use App\Infrastructure\Service\BcryptPasswordHasher;
use App\Infrastructure\Service\OrdersAdminSDKService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PasswordHasher::class, BcryptPasswordHasher::class);
    }
}
