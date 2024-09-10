<?php

namespace App\Http\Requests\Aparelho;

use App\Http\Requests\BaseRequest;

class CriarAparelhoRequest extends BaseRequest
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
            'numero_serie' => 'required|max:50',
            'nome' => 'required|max:50',
            'tipo' => 'required|max:50',
            'cliente_id' => 'required|exists:cliente,id',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
