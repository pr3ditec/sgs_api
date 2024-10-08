<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{

    public function run(): void
    {

        $tipo_usuario = [
            ["nome" => "ADMINISTRADOR", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "SUPORTE", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "ASSINANTE", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
        ];

        DB::table('tipo_usuario')->insert($tipo_usuario);
    }

}
