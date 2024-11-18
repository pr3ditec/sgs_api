<?php

namespace App\Models;

use App\Http\Helpers\Sessao;
use Carbon\Carbon;
use Exception;
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
            ->where("usuario_id", "=", Sessao::getSessionUser())
            ->orderBy("numero", "DESC")
            ->get();

        foreach ($ordem_servico as $key => $os) {

            $ordem_servico[$key]->equipamentos = ItemOsEquipamento::getAllServices($os->id);
            $ordem_servico[$key]->cliente = Cliente::find($os->cliente_id);
        }

        return $ordem_servico;
    }

    protected static function getAllDataById(int $id)
    {

        $ordem_servico = DB::table("ordem_servico")
            ->select(["ordem_servico.*", "cliente.nome"])
            ->leftJoin("cliente", "cliente.id", "=", "ordem_servico.cliente_id")
            ->where("ordem_servico.id", "=", $id)->first();
        $ordem_servico->equipamentos = ItemOsEquipamento::getAllServices($id);

        return $ordem_servico;
    }

    protected static function dataFormatedToCalendar(int $usuario_id)
    {
        return DB::table('ordem_servico')
            ->leftJoin('cliente', 'cliente.id', '=', 'ordem_servico.cliente_id')
            ->select([
                'ordem_servico.id as id',
                DB::raw('DATE(ordem_servico.data_os) as start'),
                DB::raw('CASE WHEN ordem_servico.recebido = 1 THEN "black" ELSE "black" END AS "backgroundColor"'),
                'cliente.nome as title',
                'cliente.telefone as telefone',
            ])
            ->where("ordem_servico.usuario_id", "=", $usuario_id)
            ->orderBy('ordem_servico.data_os')
            ->get();
    }

    protected static function getGreaterThen1Year()
    {
        return DB::table('ordem_servico')
            ->select('ordem_servico.id as id', 'ordem_servico.numero as ordem_servico', 'cliente.nome as cliente', 'cliente.telefone as telefone')
            ->leftJoin('cliente', 'cliente.id', '=', 'ordem_servico.cliente_id')
            ->where('ordem_servico.data_os', '<', Carbon::now()->subYear())
            ->orderBy('ordem_servico.data_os')
            ->get();
    }

    protected static function parametersDashboard()
    {
        return DB::table('ordem_servico')
            ->selectRaw('
        COUNT(*) AS total_ordem_servico,
        SUM(CASE WHEN data_os >= ? THEN 1 ELSE 0 END) AS ultimos_30_dias,
        SUM(CASE WHEN MONTH(data_os) = ? AND YEAR(data_os) = ? THEN 1 ELSE 0 END) AS mes_atual
    ', [Carbon::now()->subDays(30), Carbon::now()->month, Carbon::now()->year])
            ->first();
    }

    protected static function getNextServiceOrder()
    {
        try {
            $last_service_order = DB::table("ordem_servico")->select("numero")->orderBy("numero", "desc")->limit(1)->get();
            return ((int) $last_service_order[0]->numero) + 1;
        } catch (Exception $e) {
            return 0001;
        }
    }
}
