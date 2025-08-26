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

        $userRole = $this->input('role');

        return [
            'username' => ['required','string', Rule::unique('users','username')->ignore($userId)],
            'nome'     => ['required','string','max:100'],
            'cognome'  => ['required','string','max:100'],

            'password' => ['sometimes','nullable','string','confirmed', Password::min(8)->letters()->numbers()],

            'data_nascita'          => ['sometimes','nullable','date','after:1940-01-01', 'before:today'],
            'id_centro_assistenza'  => ['sometimes','nullable','integer','exists:centro_assistenza,id'],

            'prodotti'   => ['sometimes','array'],
            'prodotti.*' => ['integer', 'exists:prodotto,id'],
        ];
    }
}
