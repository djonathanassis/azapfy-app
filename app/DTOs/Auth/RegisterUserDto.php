<?php

declare(strict_types=1);

namespace App\DTOs\Auth;

use App\DTOs\AbstractDto;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class RegisterUserDto extends AbstractDto
{
    public function __construct(
        readonly public string $name,
        readonly public string $email,
        readonly public string $password,
    ) {
    }

    public static function fromApiRequest(ValidatesWhenResolved $resolved): self
    {
        return new self(
            name: $resolved->validated('name'),
            email: $resolved->validated('email'),
            password: $resolved->validated('password')
        );
    }
}
