<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class NewUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->numbers()],
            'nome' => ['required', 'string', 'max:100'],
            'cognome' => ['required', 'string'],
            'role' => ['required', Rule::in(['tecnico', 'staff','admin'])]
        ];

        return $rules;
    }
}
