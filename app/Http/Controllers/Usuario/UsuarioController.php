<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use Exception;

class UsuarioController extends Controller
{

    public function index()
    {
        try {

        } catch (Exception $e) {

            return Response::send(400, false, 'index-user-error', $e->getMessage());
        }
    }

}
