<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBauchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bauchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_planilla');
            $table->foreign("id_planilla")->references("id")->on("planillas"); 
            $table->unsignedBigInteger('id_empleado');
            $table->foreign("id_empleado")->references("id")->on("empleados"); 
            $table->integer("precio_hora");
            $table->integer("hora_ordinaria");
            $table->decimal("hora_extra");
            $table->decimal("deducciones");
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
        Schema::dropIfExists('bauchers');
    }
}
