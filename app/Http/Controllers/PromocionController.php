<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePromocionRequest;
use App\Http\Requests\UpdatePromocionRequest;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocion = Promocion::all();
        return view("promocion/index")->with("promocion",$promocion);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $promocion = DB::table('inventario')->select("inventario.id AS id","nombre", "codigo", 
        DB::raw("MAX(inventario.venta) AS venta, SUM(inventario.cantidad) - SUM(vendido) AS cantidad, 
        ((SUM(inventario.cantidad) - SUM(vendido))*MAX(inventario.venta)) AS total"), "vencimiento")
        ->join("productos", "productos.id","=","inventario.id")->groupby("inventario.id")
        ->join("producto__comprados", "producto__comprados.id_producto","=","productos.id")
        ->join("vencer_entradas", "vencer_entradas.id_compra","=","producto__comprados.id")
        ->groupby("inventario.id")
        ->where("vencer_entradas.id",$id)->first();
        return view("promocion/create")->with("promocion",$promocion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromocionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $rules=[
            'precionuevo' => 'required|numeric|min:0',
        ];
        $mensaje=[
            'precionuevo.required' => 'El precio nuevo no puede estar vacío',
            'precionuevo.numeric' => 'En precio nuevo no debe de incluir letras ni signos',
            'precionuevo.min' => 'En precio nuevo no debe de ser negativo',
        ];

        $this->validate($request,$rules,$mensaje);

        $promocion = DB::table('inventario')->select("inventario.id AS id","nombre", "codigo", "id_producto",
        DB::raw("MAX(inventario.venta) AS venta, SUM(inventario.cantidad) - SUM(vendido) AS cantidad, 
        ((SUM(inventario.cantidad) - SUM(vendido))*MAX(inventario.venta)) AS total"), "vencimiento")
        ->join("productos", "productos.id","=","inventario.id")->groupby("inventario.id")
        ->join("producto__comprados", "producto__comprados.id_producto","=","productos.id")
        ->join("vencer_entradas", "vencer_entradas.id_compra","=","producto__comprados.id")
        ->groupby("inventario.id")
        ->where("vencer_entradas.id",$id)->first();

        $prom = new Promocion();

        $prom->id_producto = $promocion->id_producto;
        $prom->anterior = $promocion->total/$promocion->cantidad;
        $prom->nuevo = $request->input('precionuevo');


        $creado = $prom->save();

        return redirect()->route('promociones.index')
                ->with('mensaje', 'La promocion fue creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function show(Promocion $promocion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promocion $promocion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromocionRequest  $request
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromocionRequest $request, Promocion $promocion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promocion $promocion)
    {
        //
    }
}
