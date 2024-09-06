<?php

namespace App\Models;

use App\Http\Helpers\Sessao;
use Carbon\Carbon;
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

        $ordem_servico = DB::table('ordem_servico')
            ->where("usuario_id", "=", Sessao::getSessionUser())->get();

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

    protected static function dataFormatedToCalendar(int $usuario_id)
    {
        return DB::table('ordem_servico')
            ->leftJoin('cliente', 'cliente.id', '=', 'ordem_servico.cliente_id')
            ->select([
                'ordem_servico.id as id',
                DB::raw('DATE(ordem_servico.created_at) as start'),
                DB::raw('CASE WHEN ordem_servico.recebido = 1 THEN "green" ELSE "black" END AS "backgroundColor"'),
                'cliente.nome as title',
            ])
            ->where("ordem_servico.usuario_id", "=", $usuario_id)
            ->get();
    }

    protected static function getGreaterThen1Year()
    {
        return DB::table('ordem_servico')
            ->select('ordem_servico.id as id', 'ordem_servico.numero as ordem_servico', 'cliente.nome as cliente', 'cliente.telefone as telefone')
            ->leftJoin('cliente', 'cliente.id', '=', 'ordem_servico.cliente_id')
            ->where('ordem_servico.updated_at', '<', Carbon::now()->subYear())
            ->orderBy('ordem_servico.updated_at')
            ->get();
    }

    protected static function parametersDashboard()
    {
        return DB::table('ordem_servico')
            ->selectRaw('
        COUNT(*) AS total_ordem_servico,
        SUM(CASE WHEN updated_at >= ? THEN 1 ELSE 0 END) AS ultimos_30_dias,
        SUM(CASE WHEN MONTH(updated_at) = ? AND YEAR(updated_at) = ? THEN 1 ELSE 0 END) AS mes_atual
    ', [Carbon::now()->subDays(30), Carbon::now()->month, Carbon::now()->year])
            ->first();
    }
}
