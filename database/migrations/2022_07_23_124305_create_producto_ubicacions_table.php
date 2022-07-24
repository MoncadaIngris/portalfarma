<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoUbicacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_ubicacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estante');
            $table->foreign("id_estante")->references("id")->on("estantes");
            $table->unsignedBigInteger('id_fila');
            $table->foreign("id_fila")->references("id")->on("filas");
            $table->unsignedBigInteger('id_columna');
            $table->foreign("id_columna")->references("id")->on("columnas");
            $table->unsignedBigInteger('id_producto')->nullable();
            $table->foreign("id_producto")->references("id")->on("productos");
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
        Schema::dropIfExists('producto_ubicacions');
    }
}
