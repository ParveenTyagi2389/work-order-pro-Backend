<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class WorkOrderRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'site_id'=>['required','integer','exists:sites,id'],
            'job_created_at'=>['nullable','date'],
            'technician_id'=>['nullable','integer','exists:technicians,id'],
            'job_code_id'=>['nullable','integer','exists:job_codes,id'],
            'customer_work_order'=>['nullable','string','max:100'],
            'problem'=>['nullable','string'],
            'solution'=>['nullable','string'],
            'override_travel'=>['nullable','numeric','min:0','max:99999999.99'],
            'override_labor'=>['nullable','numeric','min:0','max:99999999.99'],
            'fuel_reimbursement'=>['sometimes','boolean'],
            'serviced'=>['sometimes','boolean'],
            'billed'=>['sometimes','boolean'],
        ];
    }
}
