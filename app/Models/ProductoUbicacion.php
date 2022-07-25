<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoUbicacion extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }

    public function filas(){
        return $this->belongsTo(Fila::class, 'id_fila', 'id');
    }

    public function estantes(){
        return $this->belongsTo(Estante::class, 'id_estante', 'id');
    }

    public function columnas(){
        return $this->belongsTo(Columna::class, 'id_columna', 'id');
    }
}
