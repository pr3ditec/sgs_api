<?php

namespace App\Models;

use App\Http\Helpers\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servico extends Model
{
    use HasFactory;
    use Query;

    protected $table = 'servico';
    protected $guarded = [];

    public static function getUserServices(int $usuario_id)
    {
        return DB::table('servico')->where('usuario_id', '=', $usuario_id)->get();
    }

    public static function getServiceInfo(int $servico_id)
    {
        return DB::table("servico")
            ->select([
                "servico.id",
                "servico.descricao",
                DB::raw('CAST(servico.preco AS DECIMAL(9,2)) as preco'),
            ])
            ->where("id", "=", $servico_id)
            ->get()
            ->first();
    }
}
