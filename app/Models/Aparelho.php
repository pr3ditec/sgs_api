<?php

namespace App\Models;

use App\Http\Helpers\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparelho extends Model
{
    use HasFactory;
    use Query;

    protected $table = 'aparelho';
    protected $guarded = [];
}
