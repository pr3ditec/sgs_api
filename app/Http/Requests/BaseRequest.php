<?php

namespace App\Http\Requests;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Helpers\Response;
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
        throw new HttpResponseException(
            Response::send(
                ResponseCode::ValidationError,
                ResponseStatus::Failed,
                "validation-error",
                $validator->errors()
            )
        );
    }

    public function responseMessages(): array
    {
        return [
            'required' => 'O atributo :attribute não pode estar vazio',
            'max' => 'O atributo :attribute não pode exceder :max caracteres',
            'min' => 'O atributo :attribute nâo pode ser menor que :min caracteres',
            'boolean' => 'O atributo :attribute precisa ser do true/false',
            'exists' => 'O atributo :attribute não existe',
            'unique' => 'O atributo :attribute já existe',
            'email' => 'O atributo :attribute precisa ser um email válido',
            'digits' => 'O atributo s:attribute precisa ter :digits digitos',
            'numeric' => 'O atributo :attribute precisa ser do tipo numérico',
            'alpha_num' => 'O atributo :attribute precisa ser somente letras',
            'prohibits' => 'O atributo :attribute bloqueia os campos :fields',
            'array' => 'O atributo :attribute precisa ser um array',
            'integer' => "O atributo :attribute precisa ser do tipo inteiro",
            'uppercase' => "O atributo :attribute precisa ser uppercase",
        ];
    }
}
