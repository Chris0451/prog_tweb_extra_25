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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $role = $this->input('role');

        $rules = [
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->numbers()],
            'nome' => ['required', 'string', 'max: 100'],
            'cognome' => ['required', 'string', 'max: 100'],
            'role' => ['required', Rule::in(['tecnico','staff'])]
        ];

        if ($role === 'tecnico') {
            $rules += [
                'specializzazione'      => ['required','string','max:100'],
                'data_nascita'          => ['required','date','before:today','after:1940-01-01'],
                'id_centro_assistenza'  => ['required','integer','exists:centro_assistenza,id'],
            ];
        }

        if ($role === 'staff') {
            $rules += [
                'prodotti'   => ['required','array'],
                'prodotti.*' => ['integer','exists:prodotto,id'],
            ];
        }

        return $rules;
    }
}
