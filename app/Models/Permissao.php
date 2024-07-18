<?php

namespace App\Models;

use App\Http\Helpers\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permissao extends Model
{
    use HasFactory;
    use Query;

    protected $table = "permissao";
    protected $guarded = [];

    public static function getPermissionOwner(int $permission_id)
    {
        return DB::table('permissao')
            ->leftJoin('usuario_permissao', 'usuario_permissao.permissao_id', '=', 'permissao.id')
            ->leftJoin('usuario', 'usuario.id', '=', 'usuario_permissao.usuario_id')
            ->select(['permissao.nome as permissao', 'usuario.id as usuario_id', 'usuario.nome as usuario_nome'])
            ->where('permissao.id', '=', $permission_id)
            ->get();
    }
}
