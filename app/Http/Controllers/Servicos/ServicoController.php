<?php

namespace App\Http\Controllers\Servicos;

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

                return Response::send(404, false, 'index-service-empty');
            }

            return Response::send(200, true, 'index-service-success', $servico);
        } catch (Exception $e) {

            return Response::send(400, false, 'index-service-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $servico = Servico::findOrFail($id);

            return Response::send(200, true, 'show-service-success', $servico);
        } catch (ModelNotFoundException $e) {

            return Response::send(404, false, 'telephone-not-found');
        } catch (Exception $e) {

            return Response::send(400, false, 'show-service-error', $e->getMessage());
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

            return Response::send(200, true, 'store-service-success', $servico);
        } catch (Exception $e) {

            return Response::send(400, false, 'store-service-error', $e->getMessage());
        }
    }

    public function update(AlterarServicoRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(404, false, 'update-data-corupted');
            }

            $servico = Servico::findOrFail($id);
            $servico->update($request->validated());

            return Response::send(200, 'update-service-success', $servico);

        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'telephone-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'update-service-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $servico = Servico::findOrFail($id);
            $servico->delete();

            return Response::send(200, true, 'destroy-service-success', $servico);
        } catch (ModelNotFoundException $e) {

            return Response::send(404, false, 'telephone-not-found');
        } catch (Exception $e) {

            return Response::send(400, false, 'destroy-service-error', $e->getMessage());
        }
    }
}
