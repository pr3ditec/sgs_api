<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordem_servico', function (Blueprint $table) {
            $table->id();
            $table->string("numero", 10)->nullable();
            $table->boolean("concluido")->default(false);
            $table->boolean("recebido")->default(false);
            $table->foreignId("cliente_id")->references("id")->on("cliente");
            $table->foreignId("usuario_id")->references("id")->on("usuario");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_servico');
    }
};
