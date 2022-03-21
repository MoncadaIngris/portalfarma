<?php

namespace App\Http\Controllers;

use App\Models\Funcion;
use App\Http\Requests\StoreFuncionRequest;
use App\Http\Requests\UpdateFuncionRequest;

class FuncionController extends Controller
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
     * @param  \App\Http\Requests\StoreFuncionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFuncionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcion  $funcion
     * @return \Illuminate\Http\Response
     */
    public function show(Funcion $funcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcion  $funcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcion $funcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFuncionRequest  $request
     * @param  \App\Models\Funcion  $funcion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuncionRequest $request, Funcion $funcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcion  $funcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcion $funcion)
    {
        //
    }
}
