<?php

namespace App\Http\Controllers;

use App\Models\ProductoUbicacion;
use App\Http\Requests\StoreProductoUbicacionRequest;
use App\Http\Requests\UpdateProductoUbicacionRequest;

class ProductoUbicacionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductoUbicacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoUbicacionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoUbicacion  $productoUbicacion
     * @return \Illuminate\Http\Response
     */
    public function show(ProductoUbicacion $productoUbicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductoUbicacion  $productoUbicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductoUbicacion $productoUbicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductoUbicacionRequest  $request
     * @param  \App\Models\ProductoUbicacion  $productoUbicacion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoUbicacionRequest $request, ProductoUbicacion $productoUbicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoUbicacion  $productoUbicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductoUbicacion $productoUbicacion)
    {
        //
    }
}
