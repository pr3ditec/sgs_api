<?php

namespace App\Http\Controllers\Servicos;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Models\OrdemServico;
use Exception;

class CalendarioController extends Controller
{

    public function index()
    {
        try {

            $ordem_servico = OrdemServico::dataFormatedToCalendar("ordem_servico");

            if ($ordem_servico->isEmpty()) {

                return Response::send(404, false, 'index-os-empty');
            }

            return Response::send(200, true, 'index-os-success', $ordem_servico);
        } catch (Exception $e) {

            return Response::send(400, false, 'index-os-error', $e->getMessage());
        }
    }

}
