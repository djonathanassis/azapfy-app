<?php

declare(strict_types=1);

namespace App\Interfaces;

interface RegisteredInterface
{
    public function register(MethodDtoInterface $dto): void;
}
