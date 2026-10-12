<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ShapeRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        $record = $this->route('shape');
        return [
            'shape_name' => ['required','string','max:100',Rule::unique('shapes','shape_name')->ignore($record?->id)],
            'shape_code' => ['nullable','string'],
        ];
    }
}
