<?php

namespace App\Http\Controllers\Dashboard\d;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Models\OrdemServico;
use Carbon\Carbon;
use Exception;

class DashboardController extends Controller
{

    public function dashboard()
    {

        try {
            $ordem_servico = OrdemServico::getGreaterThen1Year();
            $parametros_servico = OrdemServico::parametersDashboard();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, "dashboard-data-success", [
                "parametros" => $parametros_servico,
                "ordem_servico" => $ordem_servico,
            ]);

        } catch (Exception $e) {

            return Response::send(ResponseCode::InternalError, ResponseStatus::Failed, "dashboard-data-error");
        }
    }

    public function atualizar($id)
    {
        try {

            $ordem_servico = OrdemServico::findOrFail($id);
            $ordem_servico->updated_at = Carbon::now();
            $ordem_servico->save();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, "dashboard-data-updated");
        } catch (Exception $e) {

            return Response::send(ResponseCode::InternalError, ResponseStatus::Failed, "update-date-error", $e->getMessage());
        }
    }

}
