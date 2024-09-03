<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Helpers\Token;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\Login;
use App\Models\TipoUsuario;
use App\Models\Usuario;
use App\Models\UsuarioPermissao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(AuthRequest $request)
    {
        try {

            $usuario = Usuario::where('email', '=', $request->email)->firstOrFail();

            if (!Hash::check($request->senha, $usuario->senha)) {

                throw new Exception("usuario não cadastrado");
            }

            $usuario_permissao = UsuarioPermissao::getUserPermissionArray($usuario->id);

            $login = Login::create([
                "usuario_id" => $usuario->id,
                "token" => Token::make($usuario, $usuario_permissao),
            ]);

            $tipo_usuario = TipoUsuario::find($usuario->tipo_usuario_id);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'login-success', [
                "login" => $login,
                "usuario" => [
                    "id" => $usuario->id,
                    "nome" => $usuario->nome,
                    "email" => $usuario->email,
                    "tipo" => $tipo_usuario->nome,
                ],
            ]);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'login-error', $e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        try {

            // $login = Login::where('token', '=', $request->header('Authorization'))->firstOrFail();
            // $login->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'logout-success');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'logout-error', $e->getMessage());
        }
    }

    public function check(Request $request)
    {
        return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'check-success');
    }

}
