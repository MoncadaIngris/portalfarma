<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoVendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto__vendidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign("id_venta")->references("id")->on("ventas");
            $table->unsignedBigInteger('id_producto');
            $table->foreign("id_producto")->references("id")->on("productos");
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
        Schema::dropIfExists('producto__vendidos');
    }
}
