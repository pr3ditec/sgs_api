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
            $table->string("cep", 10);
            $table->string("complemento", 100);
            $table->string("numero", 5);
            $table->unsignedBigInteger("pessoa_fisica_id")->nullable();
            $table->foreign("pessoa_fisica_id")->references("id")->on("pessoa_fisica")->onDelete("CASCADE");
            $table->unsignedBigInteger("pessoa_juridica_id")->nullable();
            $table->foreign("pessoa_juridica_id")->references("id")->on("pessoa_juridica")->onDelete("CASCADE");
            $table->foreignId("cidade_id")->references("id")->on("cidade");
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
