<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\PromoCodeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });

        $this->app->bind(PromoCodeService::class, function ($app) {
            return new PromoCodeService();
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
