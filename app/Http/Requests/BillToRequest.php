<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillToRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bill_name' => ['required', 'string', 'max:255'],
            'bill_travel' => ['nullable', 'numeric', 'min:0'],
            'bill_labor' => ['nullable', 'numeric', 'min:0'],
            'bill_fuel' => ['nullable', 'numeric', 'min:0'],
            'bill_address' => ['nullable', 'string', 'max:1000'],
            'bill_account' => ['nullable', 'string', 'max:100'],
            'bill_po' => ['nullable', 'string', 'max:100'],
            'bill_city' => ['nullable', 'string', 'max:100'],
            'bill_state' => ['nullable', 'string', 'max:100'],
            'bill_zip' => ['nullable', 'string', 'max:20'],
            'bill_phone' => ['nullable', 'string', 'max:30'],
            'contact_name' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_active' => ['nullable', 'boolean'],
        ];
    }
}
