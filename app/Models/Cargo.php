<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    public function salario()
    {
        return $this->belongsTo(SalarioHora::class,'id', 'id_cargo');
    }
}
