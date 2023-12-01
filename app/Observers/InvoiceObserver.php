<?php

declare(strict_types=1);

namespace App\Observers;

use App\Notifications\InvoiceNotify;
use Illuminate\Support\Facades\Auth;

class InvoiceObserver
{
    public function created(): void
    {
        Auth::user()?->notify(new InvoiceNotify());
    }
}
