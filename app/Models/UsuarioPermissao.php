<?php

namespace App\Models;

use App\Http\Helpers\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsuarioPermissao extends Model
{
    use HasFactory;
    use Query;

    protected $table = "usuario_permissao";
    protected $guarded = [];

    public static function getUserPermission(int $usuario_id)
    {
        return DB::table('usuario_permissao')
            ->leftJoin('permissao', 'permissao.id', '=', 'usuario_permissao.permissao_id')
            ->where('usuario_permissao.usuario_id', '=', $usuario_id)
            ->select(['permissao.nome as permissao', 'permissao.id as id'])
            ->get();
    }

}
