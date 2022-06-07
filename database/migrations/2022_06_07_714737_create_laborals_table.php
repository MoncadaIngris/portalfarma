<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laborals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado');
            $table->foreign("id_empleado")->references("id")->on("empleados");
            $table->unsignedBigInteger('id_he')->nullable();
            $table->foreign("id_he")->references("id")->on("hora_entradas");
            $table->unsignedBigInteger('id_hs')->nullable();
            $table->foreign("id_hs")->references("id")->on("hora_salidas");    
            $table->date("fecha");       
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
        Schema::dropIfExists('laborals');
    }
}
