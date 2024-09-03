<?php

namespace App\Http\Controllers\Telefone;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
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

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-telephone-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-telephone-success', $telefone);

        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-telephone-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $telefone = Telefone::findOrFail($id);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-telephone-success', $telefone);
        } catch (ModelNotFoundException $e) {
            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'telephone-not-found');
        } catch (Exception $e) {
            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'show-telephone-error', $e->getMessage());
        }
    }

    public function store(CriarTelefoneRequest $request)
    {
        try {

            $telefone = Telefone::create($request->validated());

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-telephone-success', $telefone);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-telephone-error', $e->getMessage());
        }
    }

    public function update(AlterarTelefoneRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'update-data-corupted');
            }

            $telefone = Telefone::findOrFail($id);
            $telefone->update($request->validated());

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'update-telephone-success', $telefone);

        } catch (ModelNotFoundException $e) {
            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'telephone-not-found');
        } catch (Exception $e) {
            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'update-telephone-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $telefone = Telefone::findOrFail($id);
            $telefone->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-telephone-success', $telefone);
        } catch (ModelNotFoundException $e) {
            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'telephone-not-found');
        } catch (Exception $e) {
            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-telephone-error', $e->getMessage());
        }
    }
}
