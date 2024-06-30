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
        CREATE TRIGGER validar_cpf BEFORE INSERT
            ON pessoa_fisica FOR EACH ROW
                BEGIN
                    SET NEW.cpf = (IF(LENGTH(NEW.cpf)<11,"0",NEW.cpf));
                END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER validar_cpf");
    }
};
