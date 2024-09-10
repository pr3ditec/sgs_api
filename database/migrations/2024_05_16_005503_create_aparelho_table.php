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
        Schema::create('aparelho', function (Blueprint $table) {
            $table->id();
            $table->string('numero_serie', 50);
            $table->string("nome", 50);
            $table->string("tipo", 50);
            $table->foreignId("cliente_id")->references("id")->on("cliente")->onDelete("CASCADE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparelho');
    }
};
