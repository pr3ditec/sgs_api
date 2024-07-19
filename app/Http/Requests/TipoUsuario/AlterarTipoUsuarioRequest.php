<?php

namespace App\Http\Requests\TipoUsuario;

use Illuminate\Foundation\Http\FormRequest;

class AlterarTipoUsuarioRequest extends FormRequest
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
        return [
            "nome" => "max:50|unique:tipo_usuario,nome",
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
