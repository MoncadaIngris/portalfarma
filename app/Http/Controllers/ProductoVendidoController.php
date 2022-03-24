<?php

namespace App\Http\Controllers;

use App\Models\Producto_Vendido;
use App\Http\Requests\StoreProducto_VendidoRequest;
use App\Http\Requests\UpdateProducto_VendidoRequest;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use Illuminate\Database\Console\DbCommand;

class ProductoVendidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ventas = Producto_Vendido::all();

        $puntos=[];
        foreach($ventas as $venta){
            $puntos [] = ['name' => $venta['id_venta'] ,'y' => floatval($venta['cantidad'])];
        }
        return view("graficos/graficoCliente",["data" => json_encode ($puntos)]);
     } //


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function graficostore()
    {
        $ventas = Producto_Vendido::all();

        $puntos=[];
        foreach($ventas as $venta){
            $puntos [] = ['name' => $venta['id_venta'] ,'y' => floatval($venta['cantidad'])];
        }
        return view("graficos/graficoProducto",["data" => json_encode ($puntos)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProducto_VendidoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProducto_VendidoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto_Vendido  $producto_Vendido
     * @return \Illuminate\Http\Response
     */
    public function graficoshow()
    {
        $ventas = Producto_Vendido::all();

        $puntos=[];
        foreach($ventas as $venta){
            $puntos [] = ['name' => $venta['id_venta'] ,'y' => floatval($venta['cantidad'])];
        }
        return view("graficos/graficoProveedor",["data" => json_encode ($puntos)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto_Vendido  $producto_Vendido
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto_Vendido $producto_Vendido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProducto_VendidoRequest  $request
     * @param  \App\Models\Producto_Vendido  $producto_Vendido
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProducto_VendidoRequest $request, Producto_Vendido $producto_Vendido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto_Vendido  $producto_Vendido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto_Vendido $producto_Vendido)
    {
        //
    }
}
