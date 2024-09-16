<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemOsEquipamento extends Model
{
    use HasFactory;

    protected $table = 'item_os_equipamento';
    protected $guarded = [];

    protected static function getAllServices(int $id)
    {

        $equipamentos = DB::table("item_os_equipamento")
            ->select(["item_os_equipamento.*", "aparelho.nome", "aparelho.numero_serie", "aparelho.tipo"])
            ->leftJoin("aparelho", "aparelho.id", "=", "item_os_equipamento.aparelho_id")
            ->where("item_os_equipamento.ordem_servico_id", "=", $id)->get();

        foreach ($equipamentos as $key => $value) {

            $equipamentos[$key]->servicos = DB::table("item_os_servico")
                ->select(["item_os_servico.*", "servico.descricao"])
                ->leftJoin("servico", "servico.id", "=", "item_os_servico.servico_id")
                ->where("item_os_equipamento_id", "=", $value->id)->get();
        }

        return $equipamentos;
    }
}
