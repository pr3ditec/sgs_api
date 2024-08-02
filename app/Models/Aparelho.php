<?php

namespace App\Models;

use App\Http\Helpers\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aparelho extends Model
{
    use HasFactory;
    use Query;

    protected $table = 'aparelho';
    protected $guarded = [];

    public static function getAllData()
    {
        return DB::table('aparelho')
            ->leftJoin('cliente', 'cliente.id', '=', 'aparelho.cliente_id')
            ->select([
                "aparelho.*",
                "cliente.nome as cliente_nome",
            ])
            ->get();
    }
}
