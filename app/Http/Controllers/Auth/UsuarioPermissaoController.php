<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Auth\AdicionarPermissaoRequest;
use App\Models\UsuarioPermissao;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuarioPermissaoController extends Controller
{
    public function show(int $usuario_id)
    {
        try {

            $usuario_permissao = UsuarioPermissao::getUserPermission($usuario_id);

            if ($usuario_permissao->isEmpty()) {

                return Response::send(404, false, 'user-permission-not-found');
            }

            return Response::send(200, true, 'index-user-permission-success', $usuario_permissao);

        } catch (Exception $e) {

            return Response::send(400, false, 'index-user-permission-error', $e->getMessage());
        }
    }

    public function store(AdicionarPermissaoRequest $request)
    {
        try {

            $usuario_permissao = UsuarioPermissao::create($request->validated());

            return Response::send(200, true, 'store-user-permission-success', $usuario_permissao);
        } catch (Exception $e) {

            return Response::send(400, false, 'store-user-permission-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {

            $usuario_permissao = UsuarioPermissao::findOrFail($id);
            $usuario_permissao->delete();

            return Response::send(200, true, 'destroy-user-permission-success', $usuario_permissao);
        } catch (ModelNotFoundException $e) {

            return Response::send(404, false, "user-permission-not-found");
        } catch (Exception $e) {

            return Response::send(400, false, "destroy-user-permission-error", $e->getMessage());
        }
    }
}
