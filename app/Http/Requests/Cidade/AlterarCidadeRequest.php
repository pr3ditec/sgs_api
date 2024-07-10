<?php

namespace App\Http\Requests\Cidade;

use App\Http\Requests\BaseRequest;

class AlterarCidadeRequest extends BaseRequest
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
            'nome' => 'max:30',
            'uf' => 'size:2|alpha_num:ascii|uppercase',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}