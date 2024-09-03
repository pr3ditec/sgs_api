<?php

namespace App\Services;

use App\Http\Helpers\Token;
use App\Models\Login;
use App\Models\TipoUsuario;
use App\Models\Usuario;
use App\Models\UsuarioPermissao;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function loginService(string $email, string $senha)
    {
        $usuario = Usuario::where('email', '=', $email)->firstOrFail();

        if (!Hash::check($senha, $usuario->senha)) {

            throw new Exception("usuario não cadastrado");
        }

        $usuario_permissao = UsuarioPermissao::getUserPermissionArray($usuario->id);

        $login = Login::create([
            "usuario_id" => $usuario->id,
            "token" => Token::make($usuario, $usuario_permissao),
        ]);

        $tipo_usuario = TipoUsuario::find($usuario->tipo_usuario_id);

        return [
            "login" => $login,
            "usuario" => [
                "id" => $usuario->id,
                "nome" => $usuario->nome,
                "email" => $usuario->email,
                "tipo" => $tipo_usuario->nome,
            ],
        ];
    }
    protected function logoutService()
    {}
};
