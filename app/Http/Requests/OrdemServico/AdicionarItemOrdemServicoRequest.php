<?php

namespace App\Http\Requests\OrdemServico;

use App\Http\Requests\BaseRequest;

class AdicionarItemOrdemServicoRequest extends BaseRequest
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
            "quantidade" => "required|integer",
            "preco_unitario" => "required|numeric",
            "ordem_servico_id" => "required|exists:ordem_servico,id",
            "aparelho_id" => "required|exists:aparelho,id",
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
