<?php

namespace App\Http\Controllers;

use App\Models\Fila;
use App\Http\Requests\StoreFilaRequest;
use App\Http\Requests\UpdateFilaRequest;

class FilaController extends Controller
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
     * @param  \App\Http\Requests\StoreFilaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFilaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fila  $fila
     * @return \Illuminate\Http\Response
     */
    public function show(Fila $fila)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fila  $fila
     * @return \Illuminate\Http\Response
     */
    public function edit(Fila $fila)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFilaRequest  $request
     * @param  \App\Models\Fila  $fila
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilaRequest $request, Fila $fila)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fila  $fila
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fila $fila)
    {
        //
    }
}
