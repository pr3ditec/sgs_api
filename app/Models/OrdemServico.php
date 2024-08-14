<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordem_servico';
    protected $guarded = [];

    protected static function getAllData()
    {

        $ordem_servico = DB::table('ordem_servico')->get();

        foreach ($ordem_servico as $key => $os) {

            $ordem_servico[$key]->equipamentos = ItemOsEquipamento::getAllServices($os->id);
            $ordem_servico[$key]->cliente = Cliente::find($os->cliente_id);
        }

        return $ordem_servico;
    }

    protected static function getAllDataById(int $id)
    {

        $ordem_servico = DB::table("ordem_servico")->where("id", "=", $id)->first();
        $ordem_servico->equipamentos = ItemOsEquipamento::getAllServices($id);

        return $ordem_servico;
    }
}
