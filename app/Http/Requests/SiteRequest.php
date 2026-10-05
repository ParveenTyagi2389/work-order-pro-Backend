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
        $siteId = $this->route('site')?->id;

        return [
            'cust_type_id' => ['required', 'exists:customer_types,customer_type_id'],
            'bill_to_id'   => ['required', 'exists:bill_to,id'],
            'name'         => ['required', 'string', 'max:255'],
            'site_id'      => [
                'nullable', 'string', 'max:100',
                Rule::unique('sites', 'site_id')->ignore($siteId),
            ],
            'address'   => ['nullable', 'string'],
            'city'      => ['nullable', 'string', 'max:100'],
            'state'     => ['nullable', 'string', 'max:100'],
            'zip'       => ['nullable', 'string', 'max:20'],
            'latitude'  => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'hours'     => ['nullable', 'string'],
            'notes'     => ['nullable', 'string'],
            'cvs_link'  => ['nullable', 'url', 'max:2048'],
        ];
    }
}