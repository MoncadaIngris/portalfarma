<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;
    public function detalles()
    {
        return $this->hasMany(PlanillaDetalle::class,'id_planilla');
    }
}
