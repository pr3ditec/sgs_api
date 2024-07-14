<?php

namespace App\Http\Requests\OrdemServico;

use App\Http\Requests\BaseRequest;
use App\Rules\EquipamentosRule;
use App\Rules\ServicosRule;

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
            'numero' => 'required|max:10',
            'concluido' => 'required|boolean',
            'recebido' => 'required|boolean',
            'equipamentos' => ["required", new EquipamentosRule()],
            'servicos' => ["required", new ServicosRule()],
            'cliente_id' => 'required|exists:cliente,id',
            'usuario_id' => 'required|exists:usuario,id',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
