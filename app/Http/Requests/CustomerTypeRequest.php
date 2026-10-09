<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customerTypeId = $this->route('customer_type')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('customer_types', 'name')->ignore($customerTypeId),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'customer type name',
        ];
    }
}
