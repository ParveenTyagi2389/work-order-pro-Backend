<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $site = $this->route('site');

        return [
            // `sites.customer_type` is VARCHAR in your existing database, so save the selected type name.
            'customer_type' => ['required', 'string', 'max:255'],
            'bill_to' => ['required', 'integer', 'exists:bill_tos,id'],
            'name' => ['required', 'string', 'max:255'],
            'site_id' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('sites', 'site_id')->ignore($site?->id),
            ],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'size:2'],
            'zip' => ['nullable', 'string', 'max:10'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'hours' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'cvs_link' => ['nullable', 'url', 'max:2048'],
        ];
    }
}
