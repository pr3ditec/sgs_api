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
            ->leftJoin('cidade', 'cidade.id', '=', 'cliente.cidade_id')
            ->select([
                "cliente.*",
                "pessoa_fisica.cpf",
                "pessoa_juridica.cnpj",
                "pessoa_juridica.inscricao_estadual",
                "pessoa_juridica.inscricao_municipal",
                "cidade.nome as cidade_nome"])
            ->get();
    }

}
