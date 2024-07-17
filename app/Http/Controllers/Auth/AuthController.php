<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Helpers\Token;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\Login;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(AuthRequest $request)
    {
        try {

            $usuario = Usuario::where('email', '=', $request->email)->firstOrFail();

            if (!Hash::check($request->senha, $usuario->senha)) {

                throw new Exception();
            }

            $old_login = DB::table('login')->where('usuario_id', '=', $usuario->id)->first();
            if ($old_login) {
                unset($old_login->id);
                $login = $old_login;
            } else {
                $login = Login::create([
                    "usuario_id" => $usuario->id,
                    "token" => Token::make($usuario),
                ]);
            }

            return Response::send(200, true, 'login-success', $login);
        } catch (Exception $e) {

            return Response::send(400, false, 'login-error', $e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        try {

            $login = Login::where('token', '=', $request->header('Authorization'))->firstOrFail();
            $login->delete();

            return Response::send(200, true, 'logout-success');
        } catch (Exception $e) {

            return Response::send(400, false, 'logout-error', $e->getMessage());
        }
    }

}
