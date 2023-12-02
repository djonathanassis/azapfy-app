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
       return $user->tenant_id === $invoice->tenant_id;
    }

    public function create(User $user): bool
    {
        return $user->is($user);
    }

    public function update(User $user, Invoice $invoice): bool
    {

        return $user->tenant_id === $invoice->tenant_id;
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return $user->tenant_id === $invoice->tenant_id;
    }

    public function restore(User $user, Invoice $invoice): bool
    {
        return $user->tenant_id === $invoice->tenant_id;
    }

    public function forceDelete(User $user, Invoice $invoice): bool
    {
        return $user->tenant_id === $invoice->tenant_id;
    }
}
