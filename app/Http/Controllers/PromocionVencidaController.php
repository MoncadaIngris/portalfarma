<?php

namespace App\Http\Controllers;

use App\Models\PromocionVencida;
use App\Models\Producto_vendido;
use App\Models\Promocion;

class PromocionVencidaController extends Controller
{
    public function cambiar($id)
    {
        $promocion = Promocion::FindOrFail($id);
        $vencida = new PromocionVencida();

        $vencida->id_producto = $promocion->id_producto;
        $vencida->anterior = $promocion->anterior;
        $vencida->nuevo = $promocion->nuevo;
        $vencida->inicio = $promocion->created_at;
        $vencida->final = date('Y-m-d');

        $creado = $vencida->save();

        Promocion::destroy($id);

        return redirect()->route('promociones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function venta($id)
    {
        $promocion = Promocion::where('id', $id)->first();
        $ventas = Producto_Vendido::where('id_producto',$promocion->id_producto)
        ->where('created_at','>=',$promocion->created_at)->get();

        return view('promocion/venta')->with('ventas', $ventas)->with('promocion', $promocion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromocionVencidaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromocionVencidaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromocionVencida  $promocionVencida
     * @return \Illuminate\Http\Response
     */
    public function show(PromocionVencida $promocionVencida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromocionVencida  $promocionVencida
     * @return \Illuminate\Http\Response
     */
    public function edit(PromocionVencida $promocionVencida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromocionVencidaRequest  $request
     * @param  \App\Models\PromocionVencida  $promocionVencida
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromocionVencidaRequest $request, PromocionVencida $promocionVencida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromocionVencida  $promocionVencida
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromocionVencida $promocionVencida)
    {
        //
    }
}
