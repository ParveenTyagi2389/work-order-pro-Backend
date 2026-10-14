<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class JobBillableRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'work_order_id' => ['required', 'integer', 'exists:work_orders,id'],
            'check_in' => ['nullable', 'date'],
            'check_out' => ['nullable', 'date', 'after_or_equal:check_in'],
            'description' => ['nullable', 'string'],
        ];
    }
}
