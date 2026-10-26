<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class TechnicianPayrollRequest extends FormRequest {
    public function authorize(): bool 
    { 
        return true; 
    }
    public function rules(): array
    { 

        return [
            'technician_id'=>['required','integer','exists:technicians,id'],
            'time_in_out'=>['required','date'],
            'authorized'=>['sometimes','boolean'],
            'paid'=>['sometimes','boolean'],
            'notes'=>['nullable','string'],
            'paid_check'=>['sometimes','boolean']
        ];
    }
}
