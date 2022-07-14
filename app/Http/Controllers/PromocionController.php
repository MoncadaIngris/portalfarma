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
            'descuento' => 'required',


        ];
        $mensaje=[
            'precionuevo.required' => 'El precio nuevo no puede estar vacío',
            'precionuevo.numeric' => 'En precio nuevo no debe de incluir letras ni signos',
            'precionuevo.min' => 'En precio nuevo no debe de ser negativo',
            'descuento.required' => 'El descuento no puede estar vacío',
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
                ->with('mensaje', 'La promoción fue creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promocion = Promocion::select(DB::raw('min(vencimiento) AS vencimiento'), 'promocions.id_producto', 
        'anterior', 'nuevo', 'promocions.created_at')
        ->join('producto__comprados','promocions.id_producto', '=', 'producto__comprados.id_producto')
        ->join('vencer_entradas','producto__comprados.id', '=', 'vencer_entradas.id_compra')
        ->groupby('promocions.id_producto')
        ->where('promocions.id',$id)
        ->where('vencimiento','>=',date("Y-m-d"))
        ->first();
        return view("promocion.show")->with("promocion", $promocion);
        
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
            $promocion = DB::table('inventario')->select("inventario.id AS id","nombre", "codigo",
            "producto__comprados.id_producto", "promocions.id AS id_promocion","anterior", "nuevo",
            DB::raw("MAX(inventario.venta) AS venta, SUM(inventario.cantidad) - SUM(vendido) AS cantidad, 
            ((SUM(inventario.cantidad) - SUM(vendido))*MAX(inventario.venta)) AS total"), "vencimiento")
            ->join("productos", "productos.id","=","inventario.id")->groupby("inventario.id")
            ->join("producto__comprados", "producto__comprados.id_producto","=","productos.id")
            ->join("vencer_entradas", "vencer_entradas.id_compra","=","producto__comprados.id")
            ->join("promocions", "promocions.id_producto","=","productos.id")
            ->groupby("inventario.id","vencimiento")
            ->where("promocions.id",$id)->first();
            return view("promocion/update")->with("promocion",$promocion);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromocionRequest  $request
     * @param  \App\Models\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id)
    {
        $rules=[
            'precionuevo' => 'required|numeric|min:0',
            'descuento' => 'required',

  
        ];
        $mensaje=[
            'precionuevo.required' => 'El precio nuevo no puede estar vacío',
            'precionuevo.numeric' => 'En precio nuevo no debe de incluir letras ni signos',
            'precionuevo.min' => 'En precio nuevo no debe de ser negativo',
            'descuento.required' => 'El descuento no puede estar vacío',
        
        ];

        $this->validate($request,$rules,$mensaje);
        
        $prom= Promocion::findOrFail($id);

        $prom->nuevo = $request->input('precionuevo');
        $creado = $prom->save();

        return redirect()->route('promociones.index')
                ->with('mensaje', 'La promocion fue editado exitosamente');
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
