<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string("nombres");
            $table->string("apellidos");
            $table->string("correo_electronico");
            $table->string("telefono_personal");
            $table->string("telefono_alternativo");
            $table->string("fecha de nacimiento");
            $table->string("direccion");
            $table->string("DNI");
            $table->string("fotografia");
            $table->boolean("estado")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
