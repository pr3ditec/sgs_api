<?php

namespace App\Http\Requests\OrdemServico;

use App\Http\Requests\BaseRequest;

class AdicionarServicosRequest extends BaseRequest
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
            'descricao' => 'required|uppercase|max:100',
            'preco' => 'required|numeric',
            'item_os_equipamento_id' => 'required|exists:item_os_equipamento,id',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
