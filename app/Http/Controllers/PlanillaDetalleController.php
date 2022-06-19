<?php

namespace App\Http\Controllers;

use App\Models\PlanillaDetalle;
use App\Http\Requests\StorePlanillaDetalleRequest;
use App\Http\Requests\UpdatePlanillaDetalleRequest;

class PlanillaDetalleController extends Controller
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
     * @param  \App\Http\Requests\StorePlanillaDetalleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlanillaDetalleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanillaDetalle  $planillaDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(PlanillaDetalle $planillaDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanillaDetalle  $planillaDetalle
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanillaDetalle $planillaDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlanillaDetalleRequest  $request
     * @param  \App\Models\PlanillaDetalle  $planillaDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanillaDetalleRequest $request, PlanillaDetalle $planillaDetalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanillaDetalle  $planillaDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanillaDetalle $planillaDetalle)
    {
        //
    }
}
