<?php

namespace App\Models;

use App\Http\Helpers\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    use HasFactory;
    use Query;

    protected $table = 'usuario';
    protected $guarded = [];

    public static function getAllUserData()
    {
        return DB::table('usuario')
            ->select('usuario.*', 'tipo_usuario.nome as tipo_usuario_nome')
            ->leftJoin('tipo_usuario', 'tipo_usuario.id', '=', 'usuario.tipo_usuario_id')
            ->get();
    }

}
