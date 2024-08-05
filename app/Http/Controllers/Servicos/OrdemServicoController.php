<?php

namespace App\Http\Controllers\Servicos;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\OrdemServico\CriarOrdemServicoRequest;
use App\Models\OrdemServico;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

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
        try {

            $ordem_servico = $request->except(["equipamentos", "servicos"]);
            $equipamentos = $request->only("equipamentos");
            $servicos = $request->only("servicos");

            DB::beginTransaction();

            $ordem_servico_store = OrdemServico::create($ordem_servico);

            foreach ($equipamentos as $equipamento) {

                DB::table('item_os_equipamento')->insert($equipamento);
            }

            foreach ($servicos as $servico) {

                DB::table('item_os_servico')->insert($servico);
            }

            DB::commit();

            return Response::send(200, true, 'store-os-success', $ordem_servico_store);
        } catch (Exception $e) {
            DB::rollBack();

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
