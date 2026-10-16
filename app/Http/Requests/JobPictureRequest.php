<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class JobPictureRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        $picture = $this->isMethod('post')
            ? ['required','image','mimes:jpg,jpeg,png,webp,gif','max:5120']
            : ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:5120'];
        return [
            'work_order_id' => ['required','integer','exists:work_orders,id'],
            'description' => ['nullable','string'],
            'picture' => $picture,
        ];
    }
}
