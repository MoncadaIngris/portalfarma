<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parte extends Model
{
    use HasFactory;
    public function permisos(){
        return $this->hasMany(Permiso::class);
    }

    public function modelos(){
        return $this->belongsTo(Modelo::class, 'id_modelo', 'id');
    }
}
