<?php

namespace App\Http\Controllers\Servicos;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\OrdemServico\CriarOrdemServicoRequest;
use App\Models\OrdemServico;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrdemServicoController extends Controller
{
    public function index()
    {
        try {

            $ordem_servico = OrdemServico::getAllData("ordem_servico");

            if ($ordem_servico->isEmpty()) {

                return Response::send(404, false, 'index-os-empty');
            }

            return Response::send(200, true, 'index-os-success', $ordem_servico);

        } catch (Exception $e) {

            return Response::send(400, false, 'index-os-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $ordem_servico = OrdemServico::getAllDataById($id);

            return Response::send(200, true, 'show-os-success', $ordem_servico);
        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'os-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'show-os-error', $e->getMessage());
        }
    }

    public function store(CriarOrdemServicoRequest $request)
    {
        return $request;
        try {

            $ordem_servico = OrdemServico::create($request->validated());

            return Response::send(200, true, 'store-os-success', $ordem_servico);
        } catch (Exception $e) {

            return Response::send(400, false, 'store-os-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $ordem_servico = OrdemServico::findOrFail($id);
            $ordem_servico->delete();

            return Response::send(200, true, 'destroy-os-success', $ordem_servico);
        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'os-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'destroy-os-error', $e->getMessage());
        }
    }

}
