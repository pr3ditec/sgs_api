<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ServicosSeeder extends Seeder
{

    protected const PREDITEC_USER_ID = 2;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $servicos = [
            ["descricao" => mb_strtoupper("LIMPEZA"), "preco" => "", "usuario_id" => self::PREDITEC_USER_ID, "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["descricao" => mb_strtoupper("HIGIENIZAÇÃO"), "preco" => "", "usuario_id" => self::PREDITEC_USER_ID, "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["descricao" => mb_strtoupper("INSTALAÇÃO"), "preco" => "", "usuario_id" => self::PREDITEC_USER_ID, "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
        ];
    }
}
