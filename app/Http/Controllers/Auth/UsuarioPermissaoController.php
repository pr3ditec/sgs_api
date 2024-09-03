<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
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

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'user-permission-not-found');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-user-permission-success', $usuario_permissao);

        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-user-permission-error', $e->getMessage());
        }
    }

    public function store(AdicionarPermissaoRequest $request)
    {
        try {

            $usuario_permissao = UsuarioPermissao::create($request->validated());

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-user-permission-success', $usuario_permissao);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-user-permission-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {

            $usuario_permissao = UsuarioPermissao::findOrFail($id);
            $usuario_permissao->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-user-permission-success', $usuario_permissao);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, "user-permission-not-found");
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, "destroy-user-permission-error", $e->getMessage());
        }
    }
}
