<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StorePictureRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        $picture = $this->isMethod('post')
            ? ['required','image','mimes:jpg,jpeg,png,webp,gif','max:5120']
            : ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:5120'];
        return [
            'site_id' => ['required','integer','exists:sites,id'],
            'description' => ['nullable','string'],
            'notes' => ['nullable','string'],
            'picture' => $picture,
        ];
    }
}
