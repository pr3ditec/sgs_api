<?php

namespace App\Http\Helpers;

use App\Models\Usuario;
use Illuminate\Support\Collection;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class Token
{

    public static function make(Usuario $usuario, array $permissoes): string
    {
        $credentials = [
            'sub' => $usuario->id,
            'iat' => time(),
            'exp' => time() + 86400,
            'payload' => $usuario,
            'credentials' => $permissoes,
        ];

        $token_factory = JWTFactory::customClaims($credentials)->make();
        $token = JWTAuth::encode($token_factory);

        return $token->get();
    }

}
