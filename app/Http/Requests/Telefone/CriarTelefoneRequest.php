<?php

namespace App\Http\Requests\Telefone;

use App\Http\Requests\BaseRequest;

class CriarTelefoneRequest extends BaseRequest
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
            'numero' => 'required|digits:11',
            'whatsapp' => 'required|boolean',
            'cliente_id' => 'required|exists:cliente,id',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
