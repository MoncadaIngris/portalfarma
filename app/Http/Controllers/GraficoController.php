<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto_Vendido;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    public function producto($val){

        $producto = Producto_Vendido::select("productos.nombre",DB::raw("SUM(venta*cantidad) as total"))
        ->join("productos","producto__vendidos.id_producto","=","productos.id")
        ->groupby("id_producto")
        ->paginate(10);

        $producto2 = Producto_Vendido::select("productos.nombre",DB::raw("SUM(venta*cantidad) as total"))
        ->join("productos","producto__vendidos.id_producto","=","productos.id")
        ->groupby("id_producto")
        ->get();

        $suma = 0;

        foreach($producto2 as $p){
            $suma += $p->total;
        }

        if($suma == 0){
            $suma = 1;
        }

        return view("graficos/graficoProducto")->with('productos', $producto)->with('suma', $suma)->with('productos2', $producto2)
        ->with('val', $val);

    }

    public function proveedor($val){
        $proveedor = Producto_Vendido::select("proveedors.nombre_proveedor",DB::raw("SUM(producto__vendidos.venta*producto__vendidos.cantidad) as total"))
        ->join("productos","producto__vendidos.id_producto","=","productos.id")
        ->join("producto__comprados","producto__comprados.id_producto","=","producto__vendidos.id_producto")
        ->join("compras","compras.id","=","producto__comprados.id_compra")
        ->join("proveedors","proveedors.id","=","compras.id_proveedor")
        ->groupby("id_proveedor")
        ->paginate(10);

        $proveedor2 = Producto_Vendido::select("proveedors.nombre_proveedor",DB::raw("SUM(producto__vendidos.venta*producto__vendidos.cantidad) as total"))
        ->join("productos","producto__vendidos.id_producto","=","productos.id")
        ->join("producto__comprados","producto__comprados.id_producto","=","producto__vendidos.id_producto")
        ->join("compras","compras.id","=","producto__comprados.id_compra")
        ->join("proveedors","proveedors.id","=","compras.id_proveedor")
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
        ->with('val', $val);
    }
}
