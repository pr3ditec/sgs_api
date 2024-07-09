<?php

namespace App\Http\Requests\Aparelho;

use App\Http\Requests\BaseRequest;

class AlterarAparelhoRequest extends BaseRequest
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
            'nome' => 'max:50',
            'tipo' => 'max:50',
            'cliente_id' => 'exists:cliente,id',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
