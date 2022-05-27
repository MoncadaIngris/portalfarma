<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarioDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendario_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_calendario');
            $table->foreign("id_calendario")->references("id")->on("calendarios");
            $table->unsignedBigInteger('id_empleado');
            $table->foreign("id_empleado")->references("id")->on("empleados");
            $table->unsignedBigInteger('id_jornada');
            $table->foreign("id_jornada")->references("id")->on("jornadas");
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
        Schema::dropIfExists('calendario_detalles');
    }
}
