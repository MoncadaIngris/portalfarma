<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Vendido extends Model
{
    use HasFactory;

    
    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }

    public function impuestos(){
        return $this->belongsTo(Impuesto::class, 'id_impuesto', 'id');
    }
}
