<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
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
            //
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "status" => false,
            "messageCode" => 'validation-error',
            "list" => $validator->errors(),
        ], 200));
    }

    public function responseMessages(): array
    {
        return [
            'required' => 'O :attribute não pode estar vazio',
            'max' => 'O :attribute não pode exceder :max caracteres',
            'min' => 'O :attribute nâo pode ser menor que :min caracteres',
            'boolean' => 'O :attribute precisa ser do true/false',
            'exists' => 'O :attribute não existe',
            'unique' => 'O :attribute já existe',
            'email' => 'O :attribute precisa ser um email válido',
            'digits' => 'O :attribute precisa ter :value digitos',
            'numeric' => 'O :attribute precisa ser do tipo numérico',
        ];
    }
}
