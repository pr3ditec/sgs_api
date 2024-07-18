<?php

namespace App\Http\Controllers\Auth;

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

                return Response::send(404, false, 'permission-not-found');
            }

            return Response::send(200, true, 'index-permission-success', $permissao);

        } catch (Exception $e) {

            return Response::send(400, false, 'index-permission-error', $e->getMessage());
        }
    }

    public function store(CriarPermissaoRequest $request)
    {
        try {

            $permissao = Permissao::create($request->validated());

            return Response::send(200, true, 'store-permission-success', $permissao);
        } catch (Exception $e) {

            return Response::send(400, false, 'store-permission-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {

            $permissao = Permissao::findOrFail($id);
            $permissao->delete();

            return Response::send(200, true, 'destroy-permission-success', $permissao);
        } catch (ModelNotFoundException $e) {

            return Response::send(404, false, "permission-not-found");
        } catch (Exception $e) {

            return Response::send(400, false, "destroy-permission-error", $e->getMessage());
        }
    }
}
