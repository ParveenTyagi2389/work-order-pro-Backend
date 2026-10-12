<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class TechnicianRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        $technician = $this->route('technician');
        return [
            'access' => ['required', 'integer', 'min:0'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('technicians', 'email')->ignore($technician?->id)],
            'notes' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
        ];
    }
}
