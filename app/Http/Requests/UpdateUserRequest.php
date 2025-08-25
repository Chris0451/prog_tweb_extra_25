<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->input('id'); // hidden nel form

        return [
            'id'       => ['required','integer','exists:users,id'],
            'username' => ['required','string', Rule::unique('users','username')->ignore($userId)],
            'nome'     => ['required','string','max:100'],
            'cognome'  => ['required','string','max:100'],
            'role'     => ['required', Rule::in(['tecnico','staff','admin'])],

            // password opzionale
            'password' => ['nullable','string','confirmed', Password::min(8)->letters()->numbers()],

            // campi opzionali per tecnico/staff
            'data_nascita'          => ['nullable','date'],
            'id_centro_assistenza'  => ['nullable','integer','exists:centro_assistenza,id'],
        ];
    }
}
