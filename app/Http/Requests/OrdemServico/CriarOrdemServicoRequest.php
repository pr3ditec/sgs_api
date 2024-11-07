<?php

namespace App\Http\Requests\OrdemServico;

use App\Http\Requests\BaseRequest;
use App\Rules\EquipamentoServiceRule;

class CriarOrdemServicoRequest extends BaseRequest
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
            'concluido' => 'required|boolean',
            'recebido' => 'required|boolean',
            'valor' => "required|decimal:2",
            'data_os' => 'required|date',
            'equipamentos_servicos' => ["required", new EquipamentoServiceRule()],
            'cliente_id' => 'required|exists:cliente,id',
            'usuario_id' => 'required|exists:usuario,id',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
