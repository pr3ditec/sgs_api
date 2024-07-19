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

    public static function getUserPermissionArray(int $usuario_id): array
    {
        $usuario_permissao = DB::table('usuario_permissao')
            ->leftJoin('permissao', 'permissao.id', '=', 'usuario_permissao.permissao_id')
            ->where('usuario_permissao.usuario_id', '=', $usuario_id)
            ->select('permissao.nome as permissao')
            ->get();

        $usuario_permissao_array = [];
        foreach ($usuario_permissao as $key => $value) {
            $usuario_permissao_array[$key] = $value->permissao;
        }

        return $usuario_permissao_array;
    }

}
