<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Auth\CriarPermissaoRequest;
use App\Models\Permissao;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissaoController extends Controller
{
    public function index()
    {
        try {

            $permissao = Permissao::getAll("permissao");

            if ($permissao->isEmpty()) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'permission-not-found');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-permission-success', $permissao);

        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-permission-error', $e->getMessage());
        }
    }

    public function store(CriarPermissaoRequest $request)
    {
        try {

            $permissao = Permissao::create($request->validated());

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-permission-success', $permissao);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-permission-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {

            $permissao = Permissao::findOrFail($id);
            $permissao->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-permission-success', $permissao);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, "permission-not-found");
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, "destroy-permission-error", $e->getMessage());
        }
    }
}
