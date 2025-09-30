<?php

namespace App\Http\Requests\IncidentType;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncidentTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:incident_types'],
            'description' => ['nullable', 'string'],
        ];
    }
}
