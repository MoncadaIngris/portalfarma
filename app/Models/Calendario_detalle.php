<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario_detalle extends Model
{
    use HasFactory;
    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'id_empleado', 'id');

    }
    public function jornada()
    {
        return $this->belongsTo(Jornada::class,'id_jornada', 'id');

    }
    public function calend()
    {
        return $this->belongsTo(Calendario::class,'id_calendario', 'id');

    }

}
