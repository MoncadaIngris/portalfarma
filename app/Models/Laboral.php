<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboral extends Model
{
    use HasFactory;

    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'id_empleado', 'id');
    }

    public function entrada()
    {
        return $this->belongsTo(Hora_entrada::class,'id_he', 'id');
    }

    public function salida()
    {
        return $this->belongsTo(Hora_salida::class,'id_hs', 'id');
    }

}
