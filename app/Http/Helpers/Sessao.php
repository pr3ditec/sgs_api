<?php

namespace App\Http\Helpers;

use Exception;

class Sessao
{
    public static function setSessionUser(int $usuario_id): void
    {

        session('usuario_id', $usuario_id);

    }
    public static function getSessionUser()
    {
        try {

            $usuario_id = session('usuario_id');

            return $usuario_id;
        } catch (Exception $e) {

            throw new Exception("Nenhum usuario encontrado");
        }
    }
}
