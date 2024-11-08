<?php

namespace App\Http\Controllers\Servicos;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Helpers\Sessao;
use App\Http\Requests\Servico\AlterarServicoRequest;
use App\Http\Requests\Servico\CriaiarServicoRequest;
use App\Models\Servico;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServicoController extends Controller
{
    public function index()
    {
        try {
            $servico = Servico::getUserServices(Sessao::getSessionUser());

            if ($servico->isEmpty()) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-service-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-service-success', $servico);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-service-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $servico = Servico::getServiceInfo($id);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-service-success', $servico);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'telephone-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'show-service-error', $e->getMessage());
        }
    }

    public function store(CriaiarServicoRequest $request)
    {
        try {

            $servico = Servico::create([
                "descricao" => mb_strtoupper($request->descricao),
                "preco" => $request->preco,
                "usuario_id" => Sessao::getSessionUser(),
            ]);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-service-success', $servico);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-service-error', $e->getMessage());
        }
    }

    public function update(AlterarServicoRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'update-data-corupted');
            }

            $servico = Servico::findOrFail($id);
            $servico->update($request->validated());

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'update-service-success', $servico);

        } catch (ModelNotFoundException $e) {
            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'telephone-not-found');
        } catch (Exception $e) {
            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'update-service-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $servico = Servico::findOrFail($id);
            $servico->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-service-success', $servico);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'telephone-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-service-error', $e->getMessage());
        }
    }
}
