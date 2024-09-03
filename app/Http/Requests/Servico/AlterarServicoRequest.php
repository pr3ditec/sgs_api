<?php

namespace App\Http\Requests\Servico;

use App\Http\Requests\BaseRequest;

class AlterarServicoRequest extends BaseRequest
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
            "usuario_id" => "integer|exists:usuario,id",
            "preco" => "numeric",
            "descricao" => "max:100",
        ];
    }
    public function messages(): array
    {
        return parent::responseMessages();
    }
}