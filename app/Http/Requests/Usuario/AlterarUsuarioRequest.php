<?php

namespace App\Http\Requests\Usuario;

use App\Http\Requests\BaseRequest;

class AlterarUsuarioRequest extends BaseRequest
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
            'nome' => 'max:100',
            'email' => 'email|max:50|unique:usuario,email',
            'senha' => 'max:70',
            'tipo_usuario_id' => 'int|exists:tipo_usuario,id',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
