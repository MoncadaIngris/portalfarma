<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function concentraciones(){
        return $this->belongsTo(Concentracion::class, 'concentracion', 'id');
    }

    public function productos_temporal(){
        return $this->hasMany(Producto_Temporal::class);
    }

    public function productos_comprado(){
        return $this->hasMany(Producto_Comprado::class);
    }
}
