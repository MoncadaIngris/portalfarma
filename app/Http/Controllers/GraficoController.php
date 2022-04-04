<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto_Vendido;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    public function producto(Request $request){

        $rules=[
            'start_date' => 'nullable',
            'end_date'=>'nullable|after_or_equal:start_date',
        ];

        $mensaje=[
            'end_date.after_or_equal' => 'La fecha final no puede ser mayor a la de inicio',
        ];

        $this->validate($request,$rules,$mensaje);

        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $val= $request->get('val');

        $fecha = Producto_Vendido::select(DB::raw("MIN(created_at) AS inicio,MAX(created_at) AS final"))->first();

        if($inicio == null){
            $inicio = date('d-m-Y',strtotime($fecha->inicio));
        }

        if($final == null){
            $final = date('d-m-Y',strtotime($fecha->final));
        }

        $producto = Producto_Vendido::select("productos.nombre",DB::raw("SUM(venta*cantidad) as total"))
        ->join("productos","producto__vendidos.id_producto","=","productos.id")
        ->whereBetween('producto__vendidos.created_at', [$inicio." 00:00:00", $final." 23:59:59"])
        ->groupby("id_producto")
        ->paginate(10);

        $producto2 = Producto_Vendido::select("productos.nombre",DB::raw("SUM(venta*cantidad) as total"))
        ->join("productos","producto__vendidos.id_producto","=","productos.id")
        ->whereBetween('producto__vendidos.created_at', [$inicio." 00:00:00", $final." 23:59:59"])
        ->groupby("id_producto")
        ->get();

        $suma = 0;

        foreach($producto2 as $p){
            $suma += $p->total;
        }

        if($suma == 0){
            $suma = 1;
        }

        return view("graficos/graficoProducto")
        ->with('productos', $producto)
        ->with('suma', $suma)
        ->with('inicio', $inicio)
        ->with('final', $final)
        ->with('productos2', $producto2)
        ->with('val', $val);

    }

    public function proveedor(Request $request){

        $rules=[
            'start_date' => 'nullable',
            'end_date'=>'nullable|after_or_equal:start_date',
        ];

        $mensaje=[
            'end_date.after_or_equal' => 'La fecha final no puede ser mayor a la de inicio',
        ];

        $this->validate($request,$rules,$mensaje);

        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $val= $request->get('val');

        $fecha = Producto_Vendido::select(DB::raw("MIN(created_at) AS inicio,MAX(created_at) AS final"))->first();

        if($inicio == null){
            $inicio = date('Y-m-d',strtotime($fecha->inicio));
        }

        if($final == null){
            $final = date('Y-m-d',strtotime($fecha->final));
        }

        $proveedor = Producto_Vendido::select("proveedors.nombre_proveedor",DB::raw("SUM(producto__vendidos.venta*producto__vendidos.cantidad) as total"))
        ->join("productos","producto__vendidos.id_producto","=","productos.id")
        ->join("producto__comprados","producto__comprados.id_producto","=","producto__vendidos.id_producto")
        ->join("compras","compras.id","=","producto__comprados.id_compra")
        ->join("proveedors","proveedors.id","=","compras.id_proveedor")
        ->whereBetween('producto__vendidos.created_at', [$inicio." 00:00:00", $final." 23:59:59"])
        ->groupby("id_proveedor")
        ->paginate(10);

        $proveedor2 = Producto_Vendido::select("proveedors.nombre_proveedor",DB::raw("SUM(producto__vendidos.venta*producto__vendidos.cantidad) as total"))
        ->join("productos","producto__vendidos.id_producto","=","productos.id")
        ->join("producto__comprados","producto__comprados.id_producto","=","producto__vendidos.id_producto")
        ->join("compras","compras.id","=","producto__comprados.id_compra")
        ->join("proveedors","proveedors.id","=","compras.id_proveedor")
        ->whereBetween('producto__vendidos.created_at', [$inicio." 00:00:00", $final." 23:59:59"])
        ->groupby("id_proveedor")
        ->get();

        $suma = 0;

        foreach($proveedor2 as $p){
            $suma += $p->total;
        }

        if($suma == 0){
            $suma = 1;
        }

        return view("graficos/graficoProveedor")->with('proveedors', $proveedor)->with('suma', $suma)->with('proveedors2', $proveedor2)
        ->with('val', $val)->with('inicio', $inicio)->with('final', $final);
    }
}
