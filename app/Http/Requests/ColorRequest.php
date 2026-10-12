<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ColorRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        $record = $this->route('color');
        return [
            'color_name' => ['required','string','max:100',Rule::unique('colors','color_name')->ignore($record?->id)],
            'color_code' => ['required','string',],
        ];
    }
}
