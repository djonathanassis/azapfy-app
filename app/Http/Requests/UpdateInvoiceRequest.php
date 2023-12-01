<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
            'number' => ['required', 'string', 'min:9', 'max:9'],
            'amount' => ['required', 'numeric'],
            'cnpj_retirement' => ['required', 'string'],
            'name_retirement' => ['required', 'string', 'max:100'],
            'cnpj_transporter' => ['required', 'string'],
            'name_transporter' => ['required', 'string', 'max:100'],
        ];
    }
}
