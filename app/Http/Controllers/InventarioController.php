<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Producto_Temporal;
use App\Models\Producto_Comprado;
use App\Models\Impuesto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use PDF;

class InventarioController extends Controller
{

    public function createPDF(){
        $productos = Producto_Comprado::select("id_producto as id", "productos.nombre", "productos.codigo", 
        DB::raw("sum(cantidad) AS cantidad"), DB::raw("(SUM(venta*cantidad)/sum(cantidad)) AS venta"), 
        DB::raw("sum(cantidad*venta*(1+valor)) AS total"))
        ->join('productos', 'productos.id', '=', 'id_producto')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->groupby('id_producto')
        ->orderby('productos.nombre')->get();

        $data = [
            'title' => 'Inventario',
            'date' => date('m/d/Y'),
            'productos' =>$productos,
        ];
           
        $pdf = PDF::loadView('inventario/pdf', $data);
     
        return $pdf->download('Inventario_'.date('m_d_Y').'.pdf');

    }

    public function index()
    {
        abort_if(Gate::denies('inventarios_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));


        $productos = DB::table('inventario')
        ->select("inventario.id AS id","nombre", "codigo", 
        DB::raw("MAX(venta) AS venta, SUM(cantidad) - SUM(vendido) AS cantidad, ((SUM(cantidad) - SUM(vendido))*MAX(venta)) AS total"))
        ->join("productos", "productos.id","=","inventario.id")
        ->groupby("inventario.id")
        ->get();

        return view('inventario/index')->with('productos', $productos);

    }

    public function show($id){
        abort_if(Gate::denies('inventarios_detalle'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $productos = Producto_Comprado::select("id_producto as id", "productos.nombre", "productos.codigo",
        "concentracions.descripcion as concentraciones","receta", "productos.descripcion", 
        DB::raw("(SUM(compra*cantidad)/sum(cantidad)) AS compra"),
        DB::raw("sum(cantidad) AS cantidad"), DB::raw("(SUM(venta*cantidad)/sum(cantidad)) AS venta"), 
        DB::raw("sum(cantidad*venta*(1+valor)) AS total"))
        ->join('productos', 'productos.id', '=', 'id_producto')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->join('concentracions', 'productos.concentracion', '=', 'concentracions.id')
        ->where('id_producto', $id)
        ->groupby('id_producto')
        ->orderby('productos.nombre')->get();

        return view('inventario/show')->with('producto', $productos);
    }
}
