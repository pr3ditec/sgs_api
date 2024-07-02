<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Models\Usuario;
use Exception;

class UsuarioController extends Controller
{

    public function index()
    {
        try {

            $data = Usuario::all();

            if ($data->isEmpty()) {

                return Response::send(200, false, 'user-data-empty');
            }

            return Response::send(200, true, 'index-user-success', $data);

        } catch (Exception $e) {

            return Response::send(400, false, 'index-user-error', $e->getMessage());
        }
    }

}
