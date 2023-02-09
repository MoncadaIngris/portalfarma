<?php

namespace App\Http\Controllers;

use App\Models\PromocionVencida;
use App\Models\Producto_vendido;
use App\Models\Promocion;
use App\Models\VencerEntrada;

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

    public function vencidas()
    {
        $promocion = PromocionVencida::all();
        return view("promocion/vencida")->with("promocion",$promocion);
    }

    public function vencidos()
    {
        $vencer = VencerEntrada::where('vencimiento','<=',date("Y-m-d"))->get();
        return view("vencer/vencidos")->with("vencer",$vencer);
    }

    public function ventavencidas($id)
    {
        $promocion = PromocionVencida::where('id', $id)->first();
        $ventas = Producto_Vendido::where('id_producto',$promocion->id_producto)
        ->whereBetween('created_at',[$promocion->inicio, $promocion->created_at])->get();
        return view("promocion/ventasvencidas")->with('ventas', $ventas)->with('promocion', $promocion);
    }
}
