<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InvoicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is($user);
    }

    public function view(User $user, Invoice $invoice): bool
    {
        return $invoice->user()->is($user);
    }

    public function create(User $user): bool
    {
        return $user->is($user);
    }

    public function update(User $user, Invoice $invoice): bool
    {
        return $invoice->user()->is($user);

    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return $invoice->user()->is($user);
    }

    public function restore(User $user, Invoice $invoice): bool
    {
        return false;
    }

    public function forceDelete(User $user, Invoice $invoice): bool
    {
        return false;
    }
}
