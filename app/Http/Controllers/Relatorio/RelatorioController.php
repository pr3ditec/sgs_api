<?php

namespace App\Http\Controllers\Relatorio;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Models\Cliente;

class RelatorioController extends Controller
{
    public function relatorios()
    {

        $clientes_ordem_servico = Cliente::clientsWithMostServiceOrder();
        $clientes_equipamentos = Cliente::clientsWithMostEquipments();

        return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-client-success', [
            "clientes_ordem_servico" => $clientes_ordem_servico,
            "clientes_equipamentos" => $clientes_equipamentos,
        ]);
    }
}
