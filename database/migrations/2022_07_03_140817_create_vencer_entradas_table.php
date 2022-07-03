<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVencerEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vencer_entradas', function (Blueprint $table) {
            $table->id();
            $table->date("vencimiento");
            $table->integer("cantidad");
            $table->unsignedBigInteger('id_compra');
            $table->foreign("id_compra")->references("id")->on("producto__comprados");
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
        Schema::dropIfExists('vencer_entradas');
    }
}
