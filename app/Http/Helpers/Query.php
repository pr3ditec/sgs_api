<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;

trait Query
{

    public static function getAll(string $table)
    {
        return DB::table($table)->get();
    }

}
