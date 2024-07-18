<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissaoSeeder extends Seeder
{
    public function run(): void
    {
        $permissoes = [
            ["nome" => "usuario.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "usuario.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()]    ,
            ["nome" => "usuario.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "usuario.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "usuario.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cliente.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cliente.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cliente.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cliente.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cliente.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "aparelho.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "aparelho.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "aparelho.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "aparelho.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "aparelho.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cidade.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cidade.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cidade.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cidade.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "cidade.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "telefone.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "telefone.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "telefone.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "telefone.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "telefone.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "ordem_servico.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "ordem_servico.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "ordem_servico.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "ordem_servico.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "ordem_servico.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "item_os.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "item_os.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "item_os.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "item_os.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "item_os.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "servico_os.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "servico_os.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "servico_os.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "servico_os.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "servico_os.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "permissao.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "permissao.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "permissao.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "permissao.update", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "permissao.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "usuario_permissao.index", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "usuario_permissao.show", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "usuario_permissao.store", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
            ["nome" => "usuario_permissao.destroy", "created_at" => Carbon::now(), "updated_at" => Carbon::now()],
        ];

        DB::table('permissao')->insert($permissoes);
    }
}
