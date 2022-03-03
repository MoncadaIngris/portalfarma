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
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;

class InventarioController extends Controller
{
    public function index()
    {
        $productos = Producto_Comprado::select("id_producto as id", "productos.nombre", "productos.codigo", 
        DB::raw("sum(cantidad) AS cantidad"), DB::raw("(SUM(venta*cantidad)/sum(cantidad)) AS venta"), 
        DB::raw("sum(cantidad*venta*(1+valor)) AS total"))
        ->join('productos', 'productos.id', '=', 'id_producto')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->groupby('id_producto')
        ->orderby('productos.nombre')->get();

        return view('inventario/index')->with('productos', $productos);

    }
}
