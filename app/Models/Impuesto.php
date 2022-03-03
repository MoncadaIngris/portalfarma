<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    use HasFactory;

    public function productos_temporal(){
        return $this->hasMany(Producto_Temporal::class);
    }

    public function productos_comprado(){
        return $this->hasMany(Producto_Comprado::class);
    }
}
