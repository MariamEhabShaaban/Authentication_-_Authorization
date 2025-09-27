<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\PasswordService;
use App\Services\AuthServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\PasswordServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class,AuthService::class);
        $this->app->bind(PasswordServiceInterface::class,PasswordService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
