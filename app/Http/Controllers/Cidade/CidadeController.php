<?php

namespace App\Http\Controllers\Cidade;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
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

            $cidade = Cidade::getAll('cidade');

            if ($cidade->isEmpty()) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-city-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-city-success', $cidade);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-city-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $cidade = Cidade::findOrFail($id);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-city-success', $cidade);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'city-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'show-city-error', $e->getMessage());
        }
    }

    public function store(CriarCidadeRequest $request)
    {
        try {

            $cidade = Cidade::create([
                "nome" => mb_strtoupper($request->nome),
                "uf" => mb_strtoupper($request->uf),
            ]);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-city-success', $cidade);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-city-error', $e->getMessage());
        }
    }

    public function update(AlterarCidadeRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'update-data-corupted');
            }

            $cidade = Cidade::findOrFail($id);
            $cidade->update($request->validated());

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'update-city-success', $cidade);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'city-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'update-city-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $cidade = Cidade::findOrFail($id);
            $cidade->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-city-success', $cidade);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'city-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-city-error', $e->getMessage());
        }
    }
}
