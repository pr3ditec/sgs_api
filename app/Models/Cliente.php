<?php

namespace App\Models;

use App\Http\Helpers\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    use HasFactory;
    use Query;

    protected $table = 'cliente';
    protected $guarded = [];

    protected static function getAllData()
    {
        return DB::table('cliente')
            ->leftJoin('pessoa_fisica', 'pessoa_fisica.cliente_id', '=', 'cliente.id')
            ->leftJoin('pessoa_juridica', 'pessoa_juridica.cliente_id', '=', 'cliente.id')
            ->select([
                "cliente.*",
                "pessoa_fisica.cpf",
                "pessoa_juridica.cnpj",
                "pessoa_juridica.inscricao_estadual",
                "pessoa_juridica.inscricao_municipal",
            ])
            ->orderBy("cliente.nome")
            ->get();
    }

    protected static function findAllDataFromId(int $id)
    {
        return DB::table('cliente')
            ->leftJoin('pessoa_fisica', 'pessoa_fisica.cliente_id', '=', 'cliente.id')
            ->leftJoin('pessoa_juridica', 'pessoa_juridica.cliente_id', '=', 'cliente.id')
            ->select([
                "cliente.*",
                "pessoa_fisica.cpf",
                "pessoa_juridica.cnpj",
                "pessoa_juridica.inscricao_estadual",
                "pessoa_juridica.inscricao_municipal",
            ])
            ->where("cliente.id", "=", $id)
            ->get()
            ->first();
    }

    protected static function clientsWithMostServiceOrder()
    {
        return DB::table("cliente")
            ->leftJoin("ordem_servico", "ordem_servico.cliente_id", "=", "cliente.id")
            ->select([
                "cliente.nome",
                "cliente.telefone",
                "cliente.cep",
                DB::raw("count(ordem_servico.id) as 'quantidade ordem de serviço'"),
            ])
            ->groupBy("cliente.nome", "cliente.telefone", "cliente.cep")
            ->orderBy("quantidade ordem de serviço")
            ->get();
    }

    protected static function clientsWithMostEquipments()
    {
        return DB::table("cliente")
            ->leftJoin("aparelho", "aparelho.cliente_id", "=", "cliente.id")
            ->select([
                "cliente.nome",
                "cliente.telefone",
                "cliente.cep",
                DB::raw("group_concat(aparelho.nome) as equipamentos"),
                DB::raw("COUNT(aparelho.id) as 'numero de equipamentos'"),
            ])
            ->groupBy("cliente.nome", "cliente.telefone", "cliente.cep")
            ->orderBy("numero de equipamentos")
            ->get();
    }

}
