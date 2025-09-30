<?php

namespace App\Http\Requests\Incident;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIncidentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string'],
            'incident_type_id' => ['required', 'exists:incident_types,id'],
            'status' => ['sometimes', Rule::in(['reported', 'in_progress', 'resolved', 'closed'])],
        ];
    }
}
