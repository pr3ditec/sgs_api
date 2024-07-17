<?php

namespace App\Http\Helpers;

use App\Models\Usuario;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class Token
{

    public static function make(Usuario $usuario): string
    {
        $credentials = [
            'sub' => $usuario->id,
            'iat' => time(),
            'exp' => time() + 10000,
            'payload' => $usuario,
            'credentials' => [
                "usuario.index",
                "usuario.store",
            ],
        ];

        $token_factory = JWTFactory::customClaims($credentials)->make();
        $token = JWTAuth::encode($token_factory);

        return $token->get();
    }

}
