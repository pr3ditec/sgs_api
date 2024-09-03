<?php

namespace App\Http\Helpers;

use Exception;

class Sessao
{
    public static function setSessionUser($usuario_id): void
    {

        session(['usuarioid' => $usuario_id]);

    }
    public static function getSessionUser()
    {
        try {

            $usuario_id = session('usuarioid');

            return $usuario_id;
        } catch (Exception $e) {

            throw new Exception("Nenhum usuario encontrado");
        }
    }
}
