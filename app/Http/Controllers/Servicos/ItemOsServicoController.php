<?php

namespace App\Http\Controllers\Servicos;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
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

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-servicos-os-success', $servicos_os);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-servicos-os-error', $e->getMessage());
        }
    }
    public function destroy(int $item_os_servico_id)
    {
        try {

            $servicos_os = ItemOsServico::findOrFail($item_os_servico_id);
            $servicos_os->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-servicos-os-success');
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Success, 'servicos-os-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-servicos-os-error', $e->getMessage());
        }
    }
}
