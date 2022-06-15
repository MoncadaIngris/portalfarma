<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    public function scopeSearch($query, $nombres){
        return $query->where('nombres', 'LIKE', "%$nombres%");
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function cargos(){
        return $this->belongsTo(Cargo::class, 'cargo', 'id');
    }

}
