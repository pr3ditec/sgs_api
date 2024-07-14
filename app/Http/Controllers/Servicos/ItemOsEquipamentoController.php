<?php

namespace App\Http\Controllers\Servicos;

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

            return Response::send(200, true, 'store-item-os-success');
        } catch (Exception $e) {

            return Response::send(400, false, 'store-item-os-error', $e->getMessage());
        }

    }
    public function destroy(int $item_os_equipamento_id)
    {
        try {

            $item_os = ItemOsEquipamento::findOrFail($item_os_equipamento_id);
            $item_os->delete();

            return Response::send(200, true, "destroy-item-os-success");

        } catch (ModelNotFoundException $e) {

            return Response::send(404, false, 'item-os-not-found');
        } catch (Exception $e) {

            return Response::send(400, false, 'destroy-item-os-error', $e->getMessage());
        }
    }
}
