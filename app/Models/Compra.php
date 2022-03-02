<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public function proveedores(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id');
    }
}
