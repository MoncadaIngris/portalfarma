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


class CompraController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::select("compras.id", "id_proveedor", "compras.created_at", 
        DB::raw("SUM(compra * cantidad) AS subtotal"), DB::raw("SUM(compra * cantidad * valor) AS impuesto"), 
        DB::raw("SUM(compra * cantidad)+SUM(compra * cantidad * valor) AS total"))
        ->join('producto__comprados', 'id_compra', '=', 'compras.id')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->groupby('compras.id')
        ->orderby('compras.created_at')->get();

        return view('compras/index')->with('compras', $compras);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($proveedor=0, $producto = " ", $producto_id=0)
    {
        $prov = Proveedor::find($proveedor);
        $proveedors = Proveedor::all();
        $productos = Producto::all();
        $impuestos = Impuesto::all();
        $temporal = Producto_Temporal::all();
        return view('compras/create')->with('proveedors', $proveedors)
        ->with('prov', $prov)
        ->with('proveedor', $proveedor)
        ->with('productos', $productos)
        ->with('impuestos', $impuestos)
        ->with('temporal', $temporal)
        ->with('producto_name', $producto)
        ->with('producto_id', $producto_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $proveedor=0)
    {
        $compra = $request->input('compra')+0.01;

        $this->validate($request, [
            'productos' => 'required|exists:productos,id',
            "venta" => 'required|numeric|max:999999.99|min:'.$compra,
            "compra" => 'required|numeric|min:1',
            "cantidad" => "required|min:1|numeric|max:999999999",
            "impuesto" => "required|exists:impuestos,id",
        ], [
            'productos.required' => 'Debe de seleccionar un producto',
            'productos.exists' => 'El producto seleccionado es invalido',
            'venta.required' => 'El precio de venta es obligatorio',
            'venta.numeric' => 'El precio de venta es invalido',
            'venta.max' => 'El precio de venta ingresado es demasiado grande',
            'venta.min' => 'El precio de venta debe de ser mayor al precio de compra',
            'compra.required' => 'El precio de compra es obligatorio',
            'compra.min' => 'El precio de compra debe de ser mayor a 0',
            'compra.numeric' => 'El precio de compra es invalido',
            'cantidad.required' => 'La cantidad es obligatorio',
            'cantidad.max' => 'La cantidad ingresada es demasiado grande',
            'cantidad.min' => 'La cantidad no puede ser negativa',
            'cantidad.numeric' => 'La cantidad debe de ser un valor numérico',
            'impuesto.required' => 'El impuesto es obligatorio',
            'impuesto.exists' => 'El impuesto seleccionado es invalido',
            
        ]);

        $verificar = Producto_Temporal::where('id_producto', $request->input('productos'))->get();

        foreach($verificar as $v){
            $ver = $v->id;
        }

        if(isset($ver)){
            
            $productos = Producto_Temporal::findOrFail($ver);

            $cantidadtotal = $productos->cantidad + $request->input('cantidad');
            $valorcompra = $productos->cantidad*$productos->compra + $request->input('cantidad')*$request->input('compra');
            $valorventa = $productos->cantidad*$productos->venta + $request->input('cantidad')*$request->input('venta');

            $productos->compra = $valorcompra/$cantidadtotal;
            $productos->venta = $valorventa/$cantidadtotal;
            $productos->cantidad = $cantidadtotal;
            $productos->id_impuesto = $request->input('impuesto');

            $creado = $productos->save();

            if ($creado) {
                return redirect()->route('compras.create',['proveedor'=>$proveedor])
                ->with('mensaje', 'El producto fue actualizado exitosamente');
            }
            

        }else{
            $productos = new Producto_Temporal();

            $productos->id_producto = $request->input('productos');
            $productos->compra = $request->input('compra');
            $productos->venta = $request->input('venta');
            $productos->cantidad = $request->input('cantidad');
            $productos->id_impuesto = $request->input('impuesto');

            $creado = $productos->save();

            if ($creado) {
                return redirect()->route('compras.create',['proveedor'=>$proveedor])->with('mensaje2', 'El producto fue agregado exitosamente');
            }

        }

    }

    public function cambiar($valor){

        $verifican = Producto_Temporal::all();

        foreach($verifican as $verificar){
            $productos = new Producto_Comprado();

            $productos->id_producto = $verificar->id_producto;
            $productos->compra = $verificar->compra;
            $productos->venta = $verificar->venta;
            $productos->cantidad = $verificar->cantidad;
            $productos->id_impuesto = $verificar->id_impuesto;
            $productos->id_compra = $valor;

            $creado = $productos->save();
        }
            $valor = 2;
            return $this->eliminartodo($valor);
    }

    public function save(Request $request,$proveedor){

        $compra = new Compra();

        $compra->id_proveedor = $proveedor;

        $creado = $compra->save();

        $this->cambiar($compra->id);

        return redirect()->route('compras.create');
    }

    public function eliminar( $id, $proveedor){
        Producto_Temporal::destroy($id);
        return redirect()->route('compras.create',['proveedor'=>$proveedor])
        ->with('mensaje2', 'El producto fue eliminado exitosamente');
    }

    public function cancelar(){
        $valor = 1;
        return $this->eliminartodo($valor);
    }

    public function limpiar($proveedor){
        $valor = 0;
        return $this->eliminartodo($valor);
    }

    public function eliminartodo($valor){
        $val = Producto_Temporal::all();
        
        foreach($val as $i){
            Producto_Temporal::destroy($i->id);
        }
        

        if($valor == 0){
            return redirect()->route('compras.create');
        }else{
            if($valor == 2){
                return redirect()->route('compras.create')
                ->with('mensaje', 'La compra fue realizada exitosamente');
            }else{

            }
        }

    }

}
