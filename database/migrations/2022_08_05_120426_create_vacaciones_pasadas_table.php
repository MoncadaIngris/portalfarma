<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacacionesPasadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacaciones_pasadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado');
            $table->foreign("id_empleado")->references("id")->on("empleados");
            $table->date("inicio");
            $table->date("final");
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
        Schema::dropIfExists('vacaciones_pasadas');
    }
}
