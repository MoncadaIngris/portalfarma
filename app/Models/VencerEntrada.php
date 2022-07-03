<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VencerEntrada extends Model
{
    use HasFactory;

    public function compras(){
        return $this->belongsTo(Producto_Comprado::class, 'id_compra', 'id');
    }
}
