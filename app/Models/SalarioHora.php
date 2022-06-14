<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarioHora extends Model
{
    use HasFactory;
    public function jornada()
    {
        return $this->belongsTo(Jornada::class,'id_jornada', 'id');

    }
}
