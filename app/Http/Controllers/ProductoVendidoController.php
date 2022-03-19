<?php

namespace App\Http\Controllers;

use App\Models\Producto_Vendido;
use App\Http\Requests\StoreProducto_VendidoRequest;
use App\Http\Requests\UpdateProducto_VendidoRequest;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;

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
        foreach($ventas as $ventas){
            $puntos [] = ['name' => $ventas['id_venta'] ,'y' => floatval($ventas['cantidad'])];
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
    public function show(Producto_Vendido $producto_Vendido)
    {
        //
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
