<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewProductRequest extends FormRequest
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
            'nome' => 'required|string',
            'descrizione' => 'required|max:1000',
            'tecniche_uso' => 'required|max:1000',
            'mod_installazione' => 'required|max:1000',
            'modello' => 'required|max:100',
            'marca' => 'required|max:100',
            'foto' => 'nullable|max:500'
        ];
    }
}
