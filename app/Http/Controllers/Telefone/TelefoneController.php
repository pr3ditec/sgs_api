<?php

namespace App\Http\Controllers\Telefone;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Telefone\AlterarTelefoneRequest;
use App\Http\Requests\Telefone\CriarTelefoneRequest;
use App\Models\Telefone;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TelefoneController extends Controller
{
    public function index()
    {
        try {

            $telefone = Telefone::getAll('telefone');

            if ($telefone->isEmpty()) {

                return Response::send(404, false, 'index-telephone-empty');
            }

            return Response::send(200, true, 'index-telephone-success', $telefone);

        } catch (Exception $e) {

            return Response::send(400, false, 'index-telephone-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $telefone = Telefone::findOrFail($id);

            return Response::send(200, true, 'show-telephone-success', $telefone);
        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'telephone-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'show-telephone-error', $e->getMessage());
        }
    }

    public function store(CriarTelefoneRequest $request)
    {
        try {

            $telefone = Telefone::create($request->validated());

            Response::send(200, true, 'store-telephone-success', $telefone);
        } catch (Exception $e) {

            return Response::send(400, false, 'store-telephone-error', $e->getMessage());
        }
    }

    public function update(AlterarTelefoneRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(404, false, 'update-data-corupted');
            }

            $telefone = Telefone::findOrFail($id);
            $telefone->update($request->validated());

            return Response::send(200, 'update-telephone-success', $telefone);

        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'telephone-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'update-telephone-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $telefone = Telefone::findOrFail($id);
            $telefone->delete();

            return Response::send(200, true, 'destroy-telephone-success', $telefone);
        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'telephone-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'destroy-telephone-error', $e->getMessage());
        }
    }
}
