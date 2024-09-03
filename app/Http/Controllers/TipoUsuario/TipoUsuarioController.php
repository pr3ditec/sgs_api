<?php

namespace App\Http\Controllers\TipoUsuario;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\TipoUsuario\AlterarTipoUsuarioRequest;
use App\Http\Requests\TipoUsuario\CriarTipoUsuarioRequest;
use App\Models\TipoUsuario;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TipoUsuarioController extends Controller
{
    public function index()
    {
        try {

            $tipo_usuario = TipoUsuario::getAll('tipo_usuario');

            if ($tipo_usuario->isEmpty()) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-type-user-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-type-user-success', $tipo_usuario);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-type-user-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $tipo_usuario = TipoUsuario::findOrFail($id);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-type-user-success', $tipo_usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'type-user-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'show-type-user-error', $e->getMessage());
        }
    }

    public function store(CriarTipoUsuarioRequest $request)
    {
        try {

            $tipo_usuario = TipoUsuario::create([
                "nome" => mb_strtoupper($request->nome),
            ]);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-type-user-success');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-type-user-error', $e->getMessage());
        }
    }

    public function update(AlterarTipoUsuarioRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'update-data-corupted');
            }

            $tipo_usuario = TipoUsuario::findOrFail($id);
            $tipo_usuario->update([
                "nome" => mb_strtoupper($request->nome),
            ]);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'update-type-user-success', $tipo_usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'type-user-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'update-type-user-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $tipo_usuario = TipoUsuario::findOrFail($id);
            $tipo_usuario->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-type-user-success', $tipo_usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'type-user-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-type-user-error', $e->getMessage());
        }
    }
}
