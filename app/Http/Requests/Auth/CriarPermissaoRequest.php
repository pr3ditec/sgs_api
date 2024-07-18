<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class CriarPermissaoRequest extends BaseRequest
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
            "nome" => "required|max:50",
        ];
    }

    public function messages(): array
    {
        return parent::responseMessages();
    }
}
