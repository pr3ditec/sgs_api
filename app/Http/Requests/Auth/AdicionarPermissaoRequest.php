<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class AdicionarPermissaoRequest extends BaseRequest
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
            "usuario_id" => "required|int|exists:usuario,id",
            "permissao_id" => "required|int|exists:permissao,id",
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
