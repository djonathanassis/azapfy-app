<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\Cnpj;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payload.number' => ['required', 'min:9', 'max:9'],
            'payload.amount' => ['required', 'numeric'],
            'payload.date_emissary' => ['required', 'date', 'before_or_equal:today'],
            'payload.cnpj_retirement' => ['required', new Cnpj()],
            'payload.name_retirement' => ['required', 'max:100'],
            'payload.cnpj_transporter' => ['required', new Cnpj()],
            'payload.name_transporter' => ['required', 'max:100'],
        ];
    }
}
