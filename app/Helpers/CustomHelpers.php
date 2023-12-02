<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;

if (!function_exists('checkTenantId')) {
    function checkTenantId(): bool
    {
        return Auth::check() && !is_null(Auth::user()?->getAttribute('tenant_id'));
    }
}
