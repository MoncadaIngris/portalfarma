<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoCompradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto__comprados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_compra');
            $table->foreign("id_compra")->references("id")->on("compras");
            $table->unsignedBigInteger('id_producto');
            $table->foreign("id_producto")->references("id")->on("productos");
            $table->decimal("compra");
            $table->decimal("venta");
            $table->integer("cantidad");
            $table->unsignedBigInteger('id_impuesto');
            $table->foreign("id_impuesto")->references("id")->on("impuestos");
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
        Schema::dropIfExists('producto__comprados');
    }
}
