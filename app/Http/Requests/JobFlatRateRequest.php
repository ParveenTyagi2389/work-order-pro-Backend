<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class JobFlatRateRequest extends FormRequest {
 public function authorize(): bool { return true; }
 public function rules(): array { 
    return [
        'work_order_id'=>['required','integer','exists:work_orders,id'],
        'rate'=>['required','numeric','min:0','max:99999999.99'],
        'description'=>['nullable','string'],
    ];
  }
}
