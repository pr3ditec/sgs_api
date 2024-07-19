<?php

namespace App\Http\Requests\TipoUsuario;

use App\Http\Requests\BaseRequest;

class CriarTipoUsuarioRequest extends BaseRequest
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
            "nome" => "required|max:50|unique:tipo_usuario,nome",
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
