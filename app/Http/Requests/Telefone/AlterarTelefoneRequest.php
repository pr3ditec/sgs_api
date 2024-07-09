<?php

namespace App\Http\Requests\Telefone;

use App\Http\Requests\BaseRequest;

class AlterarTelefoneRequest extends BaseRequest
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
            'numero' => 'digits:11',
            'whatsapp' => 'boolean',
            'cliente_id' => 'exists:cliente,id',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
