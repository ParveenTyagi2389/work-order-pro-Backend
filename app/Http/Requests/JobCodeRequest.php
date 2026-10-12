<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class JobCodeRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        $record = $this->route('job_code');
        return [
            'foldername' => ['required','string','max:255',Rule::unique('job_codes','foldername')->ignore($record?->id)],
            'foldercolor' => ['required','string','max:255','exists:colors,color_name'],
            'foldershape' => ['required','string','max:255','exists:shapes,shape_name'],
        ];
    }
}
