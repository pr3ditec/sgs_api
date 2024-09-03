<?php

namespace App\Http\Controllers\Usuario;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Usuario\AlterarUsuarioRequest;
use App\Http\Requests\Usuario\CriarUsuarioRequest;
use App\Models\Usuario;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function index()
    {
        try {

            $usuario = Usuario::getAllUserData();

            if ($usuario->isEmpty()) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-user-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-user-success', $usuario);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-user-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $usuario = Usuario::findOrFail($id);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-user-success', $usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'user-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'show-user-error', $e->getMessage());
        }
    }

    public function store(CriarUsuarioRequest $request)
    {
        try {

            $usuario = Usuario::create([
                "nome" => strtoupper($request->nome),
                "email" => $request->email,
                "tipo_usuario_id" => $request->tipo_usuario_id,
                "senha" => Hash::make($request->senha),
            ]);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-user-success');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-user-error', $e->getMessage());
        }
    }

    public function update(AlterarUsuarioRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'update-data-corupted');
            }

            $usuario = Usuario::findOrFail($id);
            $usuario->update($request->validated());

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'update-user-success', $usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'user-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Success, 'update-user-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-user-success', $usuario);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'user-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-user-error', $e->getMessage());
        }
    }

}
