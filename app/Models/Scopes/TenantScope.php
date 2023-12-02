<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (checkTenantId()) {
            $builder->where(
                column: $model->getTable().'.tenant_id',
                operator: '=',
                value: Auth::user()?->getAttribute('tenant_id')
            );
        }

    }
}
