<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $part = $this->route('part');

        return [
            'part_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('parts', 'part_number')->ignore($part?->id),
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
