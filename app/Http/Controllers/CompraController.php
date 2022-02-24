<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($proveedor=0)
    {
        $prov = Proveedor::find($proveedor);
        $proveedors = Proveedor::all();
        $productos = Producto::all();
        return view('compras/create')->with('proveedors', $proveedors)
        ->with('prov', $prov)
        ->with('proveedor', $proveedor)
        ->with('productos', $productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompraRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompraRequest  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
