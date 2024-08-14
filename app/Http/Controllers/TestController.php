<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function getData()
    {

        $promise1 = new Promise();

        $usuario = DB::table('usuario')->get();
        $cliente = DB::table('cliente')->get();

        return response()->json([
            "usuarios" => $usuario,
            "cliente" => $cliente,
        ]);

    }

    public function getTableData()
    {
        return DB::table('usuario')->get();
    }
}
