<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cnpj implements Rule
{
    public function passes($attribute, $value): bool
    {
        $cnpj = preg_replace('/\D/', '', $value);

        if (strlen($cnpj) !== 14 || preg_match("/^{$cnpj[0]}{14}$/", $cnpj) > 0) {
            return false;
        }

        $multipliers = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $multipliers[$i + 1];
        }

        $digit1 = (($sum %= 11) < 2) ? 0 : 11 - $sum;

        if ($cnpj[12] !== $digit1) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i <= 12; $i++) {
            $sum += $cnpj[$i] * $multipliers[$i];
        }

        $digit2 = (($sum %= 11) < 2) ? 0 : 11 - $sum;

        return $cnpj[13] === $digit2;
    }

    public function message(): string
    {
        return 'O campo :attribute não é um CNPJ válido.';
    }
}
