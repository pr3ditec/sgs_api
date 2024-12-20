<?php

namespace App\Http\Helpers;

use App\Models\Usuario;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class Token
{

    static int $CEM_DIAS = 100 * 86400;

    public static function make(Usuario $usuario, array $permissoes): string
    {
        $credentials = [
            'sub' => $usuario->id,
            'iat' => time(),
            'exp' => time() + self::$CEM_DIAS,
            'payload' => $usuario,
            'credentials' => $permissoes,
        ];

        $token_factory = JWTFactory::customClaims($credentials)->make();
        $token = JWTAuth::encode($token_factory);

        return $token->get();
    }

}
