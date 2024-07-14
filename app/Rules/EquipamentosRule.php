<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EquipamentosRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (!is_array($value)) {
            $fail("O atributo :attribute precisa ser um array");
        }

        foreach ($value as $val) {

            if (!array_key_exists("servicos", $val)) {
                $fail("O atributo :attribute precisa ter a chave 'servicos'");
            }

            if (!is_array($val['servicos'])) {
                $fail("O atributo servicos precisa ser uma array");
            }
        }

    }
}
