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
            $table->string("correo_electronico")->unique();
            $table->string("telefono_personal")->unique();
            $table->string("telefono_alternativo")->unique();
            $table->string("fecha_de_nacimiento");
            $table->string("fecha_de_ingreso");
            $table->string("direccion");
            $table->string("DNI")->unique();
            $table->string("fotografia");
            $table->unsignedBigInteger('cargo');
            $table->foreign("cargo")->references("id")->on("cargos");
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
