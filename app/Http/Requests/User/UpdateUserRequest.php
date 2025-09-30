<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('user')?->id;

        return [
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'mobile_number' => ['sometimes', 'string', 'max:20'],
            'age' => ['sometimes', 'integer', 'min:1'],
            'address' => ['sometimes', 'string'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'role' => ['sometimes', Rule::in(['admin', 'patient', 'provider'])],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
