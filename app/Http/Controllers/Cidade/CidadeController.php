<?php

namespace App\Http\Controllers\Cidade;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Cidade\AlterarCidadeRequest;
use App\Http\Requests\Cidade\CriarCidadeRequest;
use App\Models\Cidade;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CidadeController extends Controller
{
    public function index()
    {
        try {

            $cidade = Cidade::getAll('usuario');

            if ($cidade->isEmpty()) {

                return Response::send(404, false, 'index-city-empty');
            }

            return Response::send(200, true, 'index-city-success', $cidade);

        } catch (Exception $e) {

            return Response::send(400, false, 'index-city-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $cidade = Cidade::findOrFail($id);

            return Response::send(200, true, 'show-city-success', $cidade);
        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'city-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'show-city-error', $e->getMessage());
        }
    }

    public function store(CriarCidadeRequest $request)
    {
        try {

            $cidade = Cidade::create($request->validated());

            Response::send(200, true, 'store-city-success', $cidade);
        } catch (Exception $e) {

            return Response::send(400, false, 'store-city-error', $e->getMessage());
        }
    }

    public function update(AlterarCidadeRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(404, false, 'update-data-corupted');
            }

            $cidade = Cidade::findOrFail($id);
            $cidade->update($request->validated());

            return Response::send(200, 'update-city-success', $cidade);

        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'city-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'update-city-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $cidade = Cidade::findOrFail($id);
            $cidade->delete();

            return Response::send(200, true, 'destroy-city-success', $cidade);
        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'city-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'destroy-city-error', $e->getMessage());
        }
    }
}
