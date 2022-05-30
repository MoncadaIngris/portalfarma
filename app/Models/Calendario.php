<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use HasFactory;

    public function semana()
    {
        return $this->belongsTo(Semana::class,'id_semana', 'id');

    }

    public function detalles(){
        return $this->hasMany(Calendario_detalle::class, 'id_calendario');
    }



}



