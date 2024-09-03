<?php

namespace App\Http\Controllers\Servicos;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Helpers\Sessao;
use App\Models\OrdemServico;
use Exception;

class CalendarioController extends Controller
{

    public function index()
    {
        try {
            $ordem_servico = OrdemServico::dataFormatedToCalendar(Sessao::getSessionUser());

            if ($ordem_servico->isEmpty()) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-os-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-os-success', $ordem_servico);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-os-error', $e->getMessage());
        }
    }

}
