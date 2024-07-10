<?php

namespace App\Http\Requests\Usuario;

use App\Http\Requests\BaseRequest;

class CriarUsuarioRequest extends BaseRequest
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
            'nome' => 'required|max:100',
            'email' => 'required|email|max:50|unique:usuario,email',
            'senha' => 'required|max:70',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
