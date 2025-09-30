<?php

namespace App\Http\Requests\IncidentType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIncidentTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('incident_type')?->id ?? $this->route('incidentType')?->id ?? null;

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('incident_types')->ignore($id)],
            'description' => ['nullable', 'string'],
        ];
    }
}
