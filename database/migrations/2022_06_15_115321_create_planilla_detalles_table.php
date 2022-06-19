<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_planilla');
            $table->foreign("id_planilla")->references("id")->on("planillas"); 
            $table->unsignedBigInteger('id_empleado');
            $table->foreign("id_empleado")->references("id")->on("empleados"); 
            $table->integer("precio_hora");

            $table->integer("hora_ordinaria_lunes");
            $table->decimal("hora_extra_lunes");

            $table->integer("hora_ordinaria_martes");
            $table->decimal("hora_extra_martes");

            $table->integer("hora_ordinaria_miercoles");
            $table->decimal("hora_extra_miercoles");

            $table->integer("hora_ordinaria_jueves");
            $table->decimal("hora_extra_jueves");

            $table->integer("hora_ordinaria_viernes");
            $table->decimal("hora_extra_viernes");

            $table->integer("hora_ordinaria_sabado");
            $table->decimal("hora_extra_sabado");

            $table->decimal("seguro");

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
        Schema::dropIfExists('planilla_detalles');
    }
}
