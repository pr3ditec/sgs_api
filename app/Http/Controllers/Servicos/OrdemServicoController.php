<?php

namespace App\Http\Controllers\Servicos;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\OrdemServico\CriarOrdemServicoRequest;
use App\Models\OrdemServico;
use Carbon\Carbon;
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

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-os-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-os-success', $ordem_servico);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-os-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $ordem_servico = OrdemServico::getAllDataById($id);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-os-success', $ordem_servico);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'os-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'show-os-error', $e->getMessage());
        }
    }

    public function store(CriarOrdemServicoRequest $request)
    {
        try {

            $ordem_servico = $request->except(["equipamentos_servicos"]);
            $equipamentos = (array) $request->only("equipamentos_servicos");

            DB::beginTransaction();

            $numero_ordem_servico = OrdemServico::getNextServiceOrder();

            $ordem_servico_store = OrdemServico::create([
                "numero" => $numero_ordem_servico,
                "concluido" => $request->concluido,
                "recebido" => $request->recebido,
                "cliente_id" => $request->cliente_id,
                "usuario_id" => $request->usuario_id,
            ]);

            foreach ($equipamentos['equipamentos_servicos'] as $equipamento) {

                $item_os_equipamento_id = DB::table('item_os_equipamento')->insertGetId([
                    "ordem_servico_id" => $ordem_servico_store->id,
                    "aparelho_id" => $equipamento['aparelho_id'],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ]);

                foreach ($equipamento['servicos'] as $servico_id) {

                    DB::table('item_os_servico')->insert([
                        "servico_id" => $servico_id,
                        "item_os_equipamento_id" => $item_os_equipamento_id,
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ]);
                }

            }

            DB::commit();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-os-success', $ordem_servico_store);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-os-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $ordem_servico = OrdemServico::findOrFail($id);
            $ordem_servico->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-os-success', $ordem_servico);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'os-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-os-error', $e->getMessage());
        }
    }

}
