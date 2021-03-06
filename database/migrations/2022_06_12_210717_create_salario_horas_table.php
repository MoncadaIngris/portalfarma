<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarioHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salario_horas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cargo');
            $table->foreign("id_cargo")->references("id")->on("cargos");
            $table->decimal("salario_hora");
            $table->decimal("salario_dia");
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
        Schema::dropIfExists('salario_horas');
    }
}
