<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Interfaces\RegisteredInterface;
use App\Models\Tenant;
use App\Models\User;
use App\Services\AbstractService;

class RegisteredService extends AbstractService implements RegisteredInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function create(array $data): void
    {
        $tenant = Tenant::query()
            ->create(['name' => $data['name']]
            );

        $tenant->users()->create($data);
    }

}
