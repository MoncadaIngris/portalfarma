<<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(" CREATE VIEW inventario AS
        (SELECT producto__comprados.id_producto as id,
        sum(producto__comprados.cantidad)AS cantidad,
        (SUM(producto__comprados.venta*producto__comprados.cantidad)/sum(producto__comprados.cantidad)) AS venta,
        0 AS vendido
        FROM producto__comprados
        JOIN productos ON productos.id =  producto__comprados.id_producto
        JOIN impuestos ON impuestos.id = producto__comprados.id_impuesto
        GROUP BY producto__comprados.id_producto)
        UNION 
        (SELECT producto__vendidos.id_producto AS id,0, 0, SUM(producto__vendidos.cantidad) AS vendido
        FROM producto__vendidos
        JOIN productos ON producto__vendidos.id_producto = productos.id
        GROUP BY producto__vendidos.id_producto) ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS inventario;");
    }
}
