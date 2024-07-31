<?php

namespace App\Http\Controllers\TipoUsuario;

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

                return Response::send(404, false, 'index-type-user-empty');
            }

            return Response::send(200, true, 'index-type-user-success', $tipo_usuario);
        } catch (Exception $e) {

            return Response::send(400, false, 'index-type-user-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $tipo_usuario = TipoUsuario::findOrFail($id);

            return Response::send(200, true, 'show-type-user-success', $tipo_usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(404, false, 'type-user-not-found');
        } catch (Exception $e) {

            return Response::send(400, false, 'show-type-user-error', $e->getMessage());
        }
    }

    public function store(CriarTipoUsuarioRequest $request)
    {
        try {

            $tipo_usuario = TipoUsuario::create([
                "nome" => mb_strtoupper($request->nome),
            ]);

            return Response::send(200, true, 'store-type-user-success');
        } catch (Exception $e) {

            return Response::send(400, false, 'store-type-user-error', $e->getMessage());
        }
    }

    public function update(AlterarTipoUsuarioRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(404, false, 'update-data-corupted');
            }

            $tipo_usuario = TipoUsuario::findOrFail($id);
            $tipo_usuario->update([
                "nome" => mb_strtoupper($request->nome),
            ]);

            return Response::send(200, 'update-type-user-success', $tipo_usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(404, false, 'type-user-not-found');
        } catch (Exception $e) {

            return Response::send(400, false, 'update-type-user-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $tipo_usuario = TipoUsuario::findOrFail($id);
            $tipo_usuario->delete();

            return Response::send(200, true, 'destroy-type-user-success', $tipo_usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(404, false, 'type-user-not-found');
        } catch (Exception $e) {

            return Response::send(400, false, 'destroy-type-user-error', $e->getMessage());
        }
    }
}
