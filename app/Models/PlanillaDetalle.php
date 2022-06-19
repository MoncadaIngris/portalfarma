<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaDetalle extends Model
{
    use HasFactory;

    public function detalles()
    {
        return $this->belongsTo(Planilla::class,'id_planilla', 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'id_empleado', 'id');
    }
}
