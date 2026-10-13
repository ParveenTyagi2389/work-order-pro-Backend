<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class JobPartRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'work_order_id' => ['required', 'integer', 'exists:work_orders,id'],
            'part_id' => ['required', 'integer', 'exists:parts,id'],
            'quantity' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'ordered' => ['sometimes', 'boolean'],
        ];
    }
}
