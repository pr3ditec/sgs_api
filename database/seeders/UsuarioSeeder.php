<?php

namespace Database\Seeders;

use App\Models\Permissao;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{

    public function run(): void
    {

        $usuario = [
            ["nome" => "SGS ADMIN", "email" => "sgs@gmail.com", "senha" => Hash::make("sgsadmin123"), "tipo_usuario_id" => "1", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "PREDITEC", "email" => "preditec@gmail.com", "senha" => Hash::make("preditec123"), "tipo_usuario_id" => "3", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
        ];

        DB::table('usuario')->insert($usuario);

        // ADD PERMISSAO AO ADM
        $permissoes = Permissao::all();
        foreach ($permissoes as $permissao) {
            DB::table('usuario_permissao')->insert([
                "usuario_id" => 1,
                "permissao_id" => $permissao->id,
            ]);
        }

    }

}
