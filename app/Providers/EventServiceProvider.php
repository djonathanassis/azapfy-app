<?php

namespace App\Providers;

use App\Listeners\SetUserIdSessionListener;
use App\Models\Invoice;
use App\Observers\InvoiceObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
    ];

    public function boot(): void
    {
        Invoice::observe(InvoiceObserver::class);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
