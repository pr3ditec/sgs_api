<?php

namespace App\Http\Controllers\Servicos;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\OrdemServico\AdicionarItemOrdemServicoRequest;
use App\Models\ItemOsEquipamento;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemOsEquipamentoController extends Controller
{
    public function store(AdicionarItemOrdemServicoRequest $request)
    {

        try {

            $item_os = ItemOsEquipamento::create($request->validated());

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-item-os-success');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-item-os-error', $e->getMessage());
        }

    }
    public function destroy(int $item_os_equipamento_id)
    {
        try {

            $item_os = ItemOsEquipamento::findOrFail($item_os_equipamento_id);
            $item_os->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, "destroy-item-os-success");

        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'item-os-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-item-os-error', $e->getMessage());
        }
    }
}
