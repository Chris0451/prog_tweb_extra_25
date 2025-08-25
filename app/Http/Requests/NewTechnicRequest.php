<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewTechnicRequest extends FormRequest
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
        return [
            'id_utente' => 'required|exists:users,id',
            'data_nascita' => 'required|before:today|after:01-01-1900',
            'id_centro_assistenza' => 'required|exists:centro_assistenza,id'
        ];
    }
}
