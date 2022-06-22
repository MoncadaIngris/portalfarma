<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baucher extends Model
{
    use HasFactory;

    public function empleados()
    {
        return $this->belongsTo(Empleado::class,'id_empleado', 'id');
    }

    public function planillas()
    {
        return $this->belongsTo(Planilla::class,'id_planilla', 'id');
    }
}
