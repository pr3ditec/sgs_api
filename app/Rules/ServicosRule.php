<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ServicosRule implements ValidationRule
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

        foreach ($value as &$val) {

            if (!array_key_exists("descricao", $val)) {

                $fail("O atributo :attribute precisa ter a chave 'descricao'");
            } else if (!ctype_upper($val['descricao'])) {

                $fail("O campo descricao precisa estar em maiusculo");
            }

            if (!array_key_exists("preco", $val)) {

                $fail("O atributo :attribute precisa ter a chave 'preco'");
            }

            if (!array_key_exists("item_os_equipamento_id", $val)) {

                $fail("O atributo :attribute precisa ter a chave 'item_os_equipamento_id'");
            }

        }

    }

}
