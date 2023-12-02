<?php

namespace App\Providers;

use App\Interfaces\InvoiceInterface;
use App\Interfaces\RegisteredInterface;
use App\Services\Auth\RegisteredService;
use App\Services\InvoiceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            InvoiceInterface::class,
            InvoiceService::class
        );
        $this->app->bind(
            RegisteredInterface::class,
            RegisteredService::class
        );

        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
