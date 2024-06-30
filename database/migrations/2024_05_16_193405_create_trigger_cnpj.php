<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER validar_cnpj BEFORE INSERT
            ON pessoa_juridica FOR EACH ROW
                BEGIN
                    SET NEW.cnpj = (IF(LENGTH(NEW.cnpj)<14,"0",NEW.cnpj));
                END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER validar_cnpj");
    }
};
