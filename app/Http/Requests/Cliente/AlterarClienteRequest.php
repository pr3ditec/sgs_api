<?php

namespace App\Http\Requests\Cliente;

use App\Http\Requests\BaseRequest;

class AlterarClienteRequest extends BaseRequest
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
            'logradouro' => 'max:255',
            'cep' => 'digits:8|numeric',
            'complemento' => 'max:100',
            'numero' => 'max:5|numeric',
            'cidade_id' => 'exists:cidade,id',
            'cpf' => 'digits:11|numeric|unique:pessoa_fisica,cpf|prohibits:cnpj,inscricao_municipal,inscricao_estadual',
            'cnpj' => 'digits:14|numeric|unique:pessoa_juridica,cnpj|prohibits:cpf',
            'inscricao_municipal' => 'digits:15|numeric|unique:pessoa_juridica,inscricao_municipal|prohibits:cpf',
            'inscricao_estadual' => 'digits:15|numeric|unique:pessoa_juridica,inscricao_estadual|prohibits:cpf',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
