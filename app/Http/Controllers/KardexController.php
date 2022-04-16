<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto_vendido;
use App\Models\Producto_Comprado;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use PDF;
use Excel;
use App\Exports\KardexExport;
use Illuminate\Support\Facades\Gate;

class KardexController extends Controller
{
    public function exportxlsx(Request $request){
        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $producto = $request->input('producto');

        $venta = Producto_Vendido::select(DB::raw("min(created_at) as fecha_inicio, max(created_at) as fecha_final"))
        ->where('id_producto',$producto)
        ->first();

        $compra = Producto_Comprado::select(DB::raw("min(created_at) as fecha_inicio, max(created_at) as fecha_final"))
       ->where('id_producto',$producto)
        ->first();

        if($venta->fecha_inicio<$compra->fecha_inicio){
            $original = $venta->fecha_inicio;
        }else{
            $original = $compra->fecha_inicio;
        }

        if($venta->fecha_final>$compra->fecha_final){
            $ultima = $venta->fecha_final;
        }else{
            $ultima = $venta->fecha_final;
        }
        

        if($inicio == null){
            if($venta->fecha_inicio<$compra->fecha_inicio){
                $inicio = $venta->fecha_inicio;
            }else{
                $inicio = $compra->fecha_inicio;
            }
        }

        if($final == null){
            if($venta->fecha_final>$compra->fecha_final){
                $final = $venta->fecha_final;
            }else{
                $final = $compra->fecha_final;
            }
        }

        $inicio = date("Y-m-d 00:00:00", strtotime($inicio));
        $final = date("Y-m-d 23:59:59", strtotime($final));
        
        $venta = Producto_Vendido::select(DB::raw("created_at, 'venta' AS descripcion, NULL, NULL, NULL, cantidad"))
        ->whereBetween('created_at', [$inicio, $final])
        ->where('id_producto',$producto);

        $compra = Producto_Comprado::select(DB::raw("created_at, 'compra' AS descripcion, cantidad as cantidad_comprada, compra, (cantidad*compra) AS total, NULL AS cantidad_vendida"))
        ->where('id_producto',$producto)
        ->union($venta)
        ->orderby("created_at")
        ->whereBetween('created_at', [$inicio, $final])
        ->get();

        $venta2 = Producto_Vendido::select(DB::raw("created_at, 'venta' AS descripcion, NULL, NULL, NULL, cantidad"))
        ->where('created_at','<' ,$inicio)
        ->where('id_producto',$producto);

        $compra2 = Producto_Comprado::select(DB::raw("created_at, 'compra' AS descripcion, cantidad as cantidad_comprada, compra, (cantidad*compra) AS total, NULL AS cantidad_vendida"))
        ->where('id_producto',$producto)
        ->union($venta2)
        ->orderby("created_at")
        ->where('created_at','<' ,$inicio)
        ->get();

        $p = Producto::findorfail($producto);

        $nombreproducto = $p -> nombre;

        return Excel::download(new KardexExport($compra, $compra2), 'Entrada_Salida_'.$nombreproducto.' _'.date('m_d_Y').'.xlsx');
    }

    public function exportcsv(Request $request){
        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $producto = $request->input('producto');

        $venta = Producto_Vendido::select(DB::raw("min(created_at) as fecha_inicio, max(created_at) as fecha_final"))
        ->where('id_producto',$producto)
        ->first();

        $compra = Producto_Comprado::select(DB::raw("min(created_at) as fecha_inicio, max(created_at) as fecha_final"))
       ->where('id_producto',$producto)
        ->first();

        if($venta->fecha_inicio<$compra->fecha_inicio){
            $original = $venta->fecha_inicio;
        }else{
            $original = $compra->fecha_inicio;
        }

        if($venta->fecha_final>$compra->fecha_final){
            $ultima = $venta->fecha_final;
        }else{
            $ultima = $venta->fecha_final;
        }
        

        if($inicio == null){
            if($venta->fecha_inicio<$compra->fecha_inicio){
                $inicio = $venta->fecha_inicio;
            }else{
                $inicio = $compra->fecha_inicio;
            }
        }

        if($final == null){
            if($venta->fecha_final>$compra->fecha_final){
                $final = $venta->fecha_final;
            }else{
                $final = $compra->fecha_final;
            }
        }

        $inicio = date("Y-m-d 00:00:00", strtotime($inicio));
        $final = date("Y-m-d 23:59:59", strtotime($final));
        
        $venta = Producto_Vendido::select(DB::raw("created_at, 'venta' AS descripcion, NULL, NULL, NULL, cantidad"))
        ->whereBetween('created_at', [$inicio, $final])
        ->where('id_producto',$producto);

        $compra = Producto_Comprado::select(DB::raw("created_at, 'compra' AS descripcion, cantidad as cantidad_comprada, compra, (cantidad*compra) AS total, NULL AS cantidad_vendida"))
        ->where('id_producto',$producto)
        ->union($venta)
        ->orderby("created_at")
        ->whereBetween('created_at', [$inicio, $final])
        ->get();

        $venta2 = Producto_Vendido::select(DB::raw("created_at, 'venta' AS descripcion, NULL, NULL, NULL, cantidad"))
        ->where('created_at','<' ,$inicio)
        ->where('id_producto',$producto);

        $compra2 = Producto_Comprado::select(DB::raw("created_at, 'compra' AS descripcion, cantidad as cantidad_comprada, compra, (cantidad*compra) AS total, NULL AS cantidad_vendida"))
        ->where('id_producto',$producto)
        ->union($venta2)
        ->orderby("created_at")
        ->where('created_at','<' ,$inicio)
        ->get();

        $p = Producto::findorfail($producto);

        $nombreproducto = $p -> nombre;

        return Excel::download(new KardexExport($compra, $compra2), 'Entrada_Salida_'.$nombreproducto.' _'.date('m_d_Y').'.csv');
    }

    public function createPDF(Request $request){
        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $producto = $request->input('producto');

        $venta = Producto_Vendido::select(DB::raw("min(created_at) as fecha_inicio, max(created_at) as fecha_final"))
        ->where('id_producto',$producto)
        ->first();

        $compra = Producto_Comprado::select(DB::raw("min(created_at) as fecha_inicio, max(created_at) as fecha_final"))
       ->where('id_producto',$producto)
        ->first();

        if($venta->fecha_inicio<$compra->fecha_inicio){
            $original = $venta->fecha_inicio;
        }else{
            $original = $compra->fecha_inicio;
        }

        if($venta->fecha_final>$compra->fecha_final){
            $ultima = $venta->fecha_final;
        }else{
            $ultima = $venta->fecha_final;
        }
        

        if($inicio == null){
            if($venta->fecha_inicio<$compra->fecha_inicio){
                $inicio = $venta->fecha_inicio;
            }else{
                $inicio = $compra->fecha_inicio;
            }
        }

        if($final == null){
            if($venta->fecha_final>$compra->fecha_final){
                $final = $venta->fecha_final;
            }else{
                $final = $compra->fecha_final;
            }
        }

        $inicio = date("Y-m-d 00:00:00", strtotime($inicio));
        $final = date("Y-m-d 23:59:59", strtotime($final));
        
        $venta = Producto_Vendido::select(DB::raw("created_at, 'venta' AS descripcion, NULL, NULL, NULL, cantidad"))
        ->whereBetween('created_at', [$inicio, $final])
        ->where('id_producto',$producto);

        $compra = Producto_Comprado::select(DB::raw("created_at, 'compra' AS descripcion, cantidad as cantidad_comprada, compra, (cantidad*compra) AS total, NULL AS cantidad_vendida"))
        ->where('id_producto',$producto)
        ->union($venta)
        ->orderby("created_at")
        ->whereBetween('created_at', [$inicio, $final])
        ->get();

        $venta2 = Producto_Vendido::select(DB::raw("created_at, 'venta' AS descripcion, NULL, NULL, NULL, cantidad"))
        ->where('created_at','<' ,$inicio)
        ->where('id_producto',$producto);

        $compra2 = Producto_Comprado::select(DB::raw("created_at, 'compra' AS descripcion, cantidad as cantidad_comprada, compra, (cantidad*compra) AS total, NULL AS cantidad_vendida"))
        ->where('id_producto',$producto)
        ->union($venta2)
        ->orderby("created_at")
        ->where('created_at','<' ,$inicio)
        ->get();

        $p = Producto::findorfail($producto);

        $nombreproducto = $p -> nombre;

        $data = [
            'title' => 'Entrada y Salida del Producto '.$nombreproducto,
            'date' => date('m/d/Y'),
            'productos' =>$compra,
            'oldproductos' =>$compra2,
        ];
           
        $pdf = PDF::loadView('kardex/pdf', $data)->setPaper('a4','landscape');
        return $pdf->download('Entrada_Salidas_'.$nombreproducto.'_'.date('m_d_Y').'.pdf');

    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('entrada_salida'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $rules=[
            'start_date' => 'nullable',
            'end_date'=>'nullable|after_or_equal:start_date',
            'producto' => 'nullable|exists:productos,id'
        ];

        $mensaje=[
            'end_date.after_or_equal' => 'La fecha final no puede ser mayor a la de inicio',
            'producto.exists' => 'El producto no existe',
        ];

        $this->validate($request,$rules,$mensaje);

        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $producto = $request->input('producto');

        $venta = Producto_Vendido::select(DB::raw("min(created_at) as fecha_inicio, max(created_at) as fecha_final"))
        ->where('id_producto',$producto)
        ->first();

        $compra = Producto_Comprado::select(DB::raw("min(created_at) as fecha_inicio, max(created_at) as fecha_final"))
       ->where('id_producto',$producto)
        ->first();


        if($venta->fecha_inicio){
            if($venta->fecha_inicio<$compra->fecha_inicio){
                $original = $venta->fecha_inicio;
            }else{
                $original = $compra->fecha_inicio;
            }
    
        }else{
            $original = $compra->fecha_inicio;
        }
        
        if($venta->fecha_final){
            if($venta->fecha_final>$compra->fecha_final){
                $ultima = $venta->fecha_final;
            }else{
                $ultima = $compra->fecha_final;
            }
        }else{
            $ultima = $compra->fecha_final;
        }
        

        if($inicio == null){
            if($venta->fecha_inicio){
                if($venta->fecha_inicio<$compra->fecha_inicio){
                    $inicio = $venta->fecha_inicio;
                }else{
                    $inicio = $compra->fecha_inicio;
                }
            }else{
                $inicio = $compra->fecha_inicio;
            }
        }

        if($final == null){
            if($venta->fecha_final>$compra->fecha_final){
                $final = $venta->fecha_final;
            }else{
                $final = $compra->fecha_final;
            }
        }

        $inicio = date("Y-m-d 00:00:00", strtotime($inicio));
        $final = date("Y-m-d 23:59:59", strtotime($final));
        
        $venta = Producto_Vendido::select(DB::raw("created_at, 'venta' AS descripcion, NULL, NULL, NULL, cantidad"))
        ->whereBetween('created_at', [$inicio, $final])
        ->where('id_producto',$producto);

        $compra = Producto_Comprado::select(DB::raw("created_at, 'compra' AS descripcion, cantidad as cantidad_comprada, compra, (cantidad*compra) AS total, NULL AS cantidad_vendida"))
        ->where('id_producto',$producto)
        ->union($venta)
        ->orderby("created_at")
        ->whereBetween('created_at', [$inicio, $final])
        ->get();

        $venta2 = Producto_Vendido::select(DB::raw("created_at, 'venta' AS descripcion, NULL, NULL, NULL, cantidad"))
        ->where('created_at','<' ,$inicio)
        ->where('id_producto',$producto);

        $compra2 = Producto_Comprado::select(DB::raw("created_at, 'compra' AS descripcion, cantidad as cantidad_comprada, compra, (cantidad*compra) AS total, NULL AS cantidad_vendida"))
        ->where('id_producto',$producto)
        ->union($venta2)
        ->orderby("created_at")
        ->where('created_at','<' ,$inicio)
        ->get();

        $prod = Producto_Comprado::select("id_producto as id", "productos.nombre", "productos.codigo", 
        DB::raw("sum(cantidad) AS cantidad"), DB::raw("(SUM(venta*cantidad)/sum(cantidad)) AS venta"), 
        DB::raw("sum(cantidad*venta*(1+valor)) AS total"),DB::raw("max(impuestos.descripcion) AS impuesto"))
        ->join('productos', 'productos.id', '=', 'id_producto')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->groupby('id_producto')
        ->orderby('productos.nombre')->get();

        return view('kardex/index')
        ->with('productos', $compra)
        ->with('oldproductos', $compra2)
        ->with('prod', $prod)
        ->with('inicio', $inicio)
        ->with('final', $final)
        ->with('ultima', $ultima)
        ->with('original', $original)
        ->with('producto', $producto);
    }
}
