<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

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

            if (!array_key_exists("quantidade", $val)) {

                $fail("O atributo :attribute precisa ter a chave 'quantidade'");

            }

            if (!array_key_exists("preco_unitario", $val)) {

                $fail("O atributo :attribute precisa ter a chave 'preco_unitario'");
            }

            if (!array_key_exists("aparelho_id", $val)) {

                $fail("O atributo :attribute precisa ter a chave 'aparelho_id'");
            } else if (!DB::table('aparelho')->where('id', '=', $val['aparelho_id'])->exists()) {

                $fail("O campo aparelho_id precisa existir na base de dados");
            }
        }

    }
}
