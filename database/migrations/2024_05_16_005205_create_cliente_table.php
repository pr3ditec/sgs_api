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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 100);
            $table->string("logradouro", 255);
            $table->string("cep", 8);
            $table->string("complemento", 100)->nullable();
            $table->string("numero", 5);
            $table->foreignId("cidade_id")->references("id")->on("cidade");
            $table->foreignId('usuario_id')->references('id')->on('usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
