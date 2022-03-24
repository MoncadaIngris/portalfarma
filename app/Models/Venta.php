<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public function clientes(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }

    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
}

public function proveedores(){
    return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id');

}
}
