<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class InvoiceDto extends AbstractDto
{
    public function __construct(
       readonly public string $number,
       readonly public float $amount,
       readonly public string $cnpj_retirement,
       readonly public string $name_retirement,
       readonly public string $cnpj_transporter,
       readonly public string $name_transporter,
    ) {
    }

    public static function fromApiRequest(ValidatesWhenResolved $resolved): self
    {
        return new self(
            number: $resolved->validated('payload.number'),
            amount: $resolved->validated('payload.amount'),
            cnpj_retirement: $resolved->validated('payload.cnpj_retirement'),
            name_retirement: $resolved->validated('payload.name_retirement'),
            cnpj_transporter: $resolved->validated('payload.cnpj_transporter'),
            name_transporter: $resolved->validated('payload.name_transporter')
        );
    }
}
