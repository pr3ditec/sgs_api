<?php

namespace App\Http\Requests\Cidade;

use App\Http\Requests\BaseRequest;

class CriarCidadeRequest extends BaseRequest
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
            'nome' => 'required|max:30',
            'uf' => 'required|size:2|alpha_num:ascii',
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
