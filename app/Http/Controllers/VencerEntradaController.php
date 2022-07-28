<?php

namespace App\Http\Controllers;

use App\Models\VencerEntrada;
use App\Models\Promocion;
use App\Models\Producto_Comprado;
use App\Http\Requests\StoreVencerEntradaRequest;
use App\Http\Requests\UpdateVencerEntradaRequest;

class VencerEntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vencer = VencerEntrada::where("vencimiento",">=",date("Y-m-d"))->get();
        $promocion = Promocion::all();
        return view("vencer/index")->with("vencer",$vencer)->with("promocion",$promocion);
    }

    public function salida()
    {
        $vencer = VencerEntrada::where("vencimiento","<=",date("Y-m-d"))->get();
        $promocion = Promocion::all();

        foreach ($vencer as $ven) {
            VencerEntrada::destroy($ven->id);
            Producto_Comprado::destroy($ven->id_compra);
        }
        
        return redirect()->route('productos.vencidos');
    }


}
