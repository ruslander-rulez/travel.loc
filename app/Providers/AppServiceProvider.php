<?php

namespace App\Providers;

use App\Application\Auth\PasswordHasher;
use App\Domain\ChatMessage\ChatMessage;
use App\Infrastructure\Service\BcryptPasswordHasher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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

		// Using Closure based composers...
		View::composer('dashboard.Layout.sidebar', function($view) {
			$countUnreadMessages = ChatMessage::query()
				->where("type", ChatMessage::TYPE_TO_ADMIN)
				->where("is_read", false)
				->count();
			$view->with('countUnreadMessages', $countUnreadMessages);
		});
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
