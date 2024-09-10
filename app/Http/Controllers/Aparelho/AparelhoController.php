<?php

namespace App\Http\Controllers\Aparelho;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Aparelho\AlterarAparelhoRequest;
use App\Http\Requests\Aparelho\CriarAparelhoRequest;
use App\Models\Aparelho;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AparelhoController extends Controller
{
    public function index()
    {
        try {

            $aparelho = Aparelho::getAllData();

            if ($aparelho->isEmpty()) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-device-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-device-success', $aparelho);

        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-device-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $aparelho = Aparelho::findOrFail($id);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-device-success', $aparelho);
        } catch (ModelNotFoundException $e) {
            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'device-not-found');
        } catch (Exception $e) {
            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'show-device-error', $e->getMessage());
        }
    }

    public function store(CriarAparelhoRequest $request)
    {
        try {

            $aparelho = Aparelho::create([
                "numero_serie" => $request->numero_serie,
                "nome" => strtoupper($request->nome),
                "tipo" => strtoupper($request->tipo),
                "cliente_id" => $request->cliente_id,
            ]);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-device-success', $aparelho);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-device-error', $e->getMessage());
        }
    }

    public function update(AlterarAparelhoRequest $request, int $id)
    {
        try {

            $aparelho = Aparelho::findOrFail($id);
            $aparelho->update([
                "nome" => $request->nome ? strtoupper($request->nome) : $aparelho->nome,
                "tipo" => $request->tipo ? strtoupper($request->tipo) : $aparelho->tipo,
                "cliente_id" => $request->cliente_id ?? $aparelho->cliente_id,
            ]);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'update-device-success', $aparelho);

        } catch (ModelNotFoundException $e) {
            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'device-not-found');
        } catch (Exception $e) {
            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'update-device-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $aparelho = Aparelho::findOrFail($id);
            $aparelho->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-device-success', $aparelho);
        } catch (ModelNotFoundException $e) {
            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'device-not-found');
        } catch (Exception $e) {
            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-device-error', $e->getMessage());
        }
    }
}
