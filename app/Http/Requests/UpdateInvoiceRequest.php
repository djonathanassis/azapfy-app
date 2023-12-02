<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\Cnpj;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payload.number' => ['required', 'string', 'min:9', 'max:9'],
            'payload.amount' => ['required', 'numeric'],
            'payload.date_emissary' => ['required', 'date', 'before_or_equal:today'],
            'payload.cnpj_retirement' => ['required', 'string', new Cnpj()],
            'payload.name_retirement' => ['required', 'string', 'max:100'],
            'payload.cnpj_transporter' => ['required', 'string', new Cnpj()],
            'payload.name_transporter' => ['required', 'string', 'max:100'],
        ];
    }
}
