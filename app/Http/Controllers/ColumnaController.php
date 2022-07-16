<?php

namespace App\Http\Controllers;

use App\Models\Columna;
use App\Http\Requests\StoreColumnaRequest;
use App\Http\Requests\UpdateColumnaRequest;

class ColumnaController extends Controller
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
     * @param  \App\Http\Requests\StoreColumnaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColumnaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Columna  $columna
     * @return \Illuminate\Http\Response
     */
    public function show(Columna $columna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Columna  $columna
     * @return \Illuminate\Http\Response
     */
    public function edit(Columna $columna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateColumnaRequest  $request
     * @param  \App\Models\Columna  $columna
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColumnaRequest $request, Columna $columna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Columna  $columna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Columna $columna)
    {
        //
    }
}
