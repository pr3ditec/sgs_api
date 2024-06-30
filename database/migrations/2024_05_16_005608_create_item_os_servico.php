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
        Schema::create('item_os_servico', function (Blueprint $table) {
            $table->id();
            $table->string("descricao", 100);
            $table->float("preco");
            $table->foreignId("item_os_equipamento_id")->references("id")->on("item_os_equipamento")->onDelete("CASCADE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_os_servico');
    }
};
