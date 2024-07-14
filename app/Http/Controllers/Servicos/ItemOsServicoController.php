<?php

namespace App\Http\Controllers\Servicos;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\OrdemServico\AdicionarServicosRequest;
use App\Models\ItemOsServico;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemOsServicoController extends Controller
{

    public function store(AdicionarServicosRequest $request)
    {
        try {

            $servicos_os = ItemOsServico::create($request->validated());

            return Response::send(200, true, 'store-servicos-os-success', $servicos_os);
        } catch (Exception $e) {

            return Response::send(400, false, 'store-servicos-os-error', $e->getMessage());
        }
    }
    public function destroy(int $item_os_servico_id)
    {
        try {

            $servicos_os = ItemOsServico::findOrFail($item_os_servico_id);
            $servicos_os->delete();

            return Response::send(200, true, 'destroy-servicos-os-success');
        } catch (ModelNotFoundException $e) {

            return Response::send(404, true, 'servicos-os-not-found');
        } catch (Exception $e) {

            return Response::send(400, false, 'destroy-servicos-os-error', $e->getMessage());
        }
    }
}
