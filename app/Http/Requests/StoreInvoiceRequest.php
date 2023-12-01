<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payload.number' => ['required', 'min:9', 'max:9'],
            'payload.amount' => ['required', 'numeric'],
            'payload.cnpj_retirement' => ['required'],
            'payload.name_retirement' => ['required', 'max:100'],
            'payload.cnpj_transporter' => ['required'],
            'payload.name_transporter' => ['required', 'max:100'],
        ];
    }
}
