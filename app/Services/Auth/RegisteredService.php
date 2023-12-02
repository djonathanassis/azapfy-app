<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Interfaces\MethodDtoInterface;
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

    public function register(MethodDtoInterface $dto): void
    {
        $tenant = Tenant::query()
            ->create(['name' => $dto->name]
            );

        $tenant->users()->create($dto->toArray());
    }

}
