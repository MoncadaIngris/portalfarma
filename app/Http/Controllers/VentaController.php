<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Producto_Temporalv;
use App\Models\Producto_vendido;
use App\Models\Impuesto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;


class VentaController extends Controller
{
    
    public function createPDF(){
        $ventas = Venta::select("ventas.id", "id_proveedor", "ventas.created_at", 
        DB::raw("SUM(venta * cantidad) AS subtotal"), DB::raw("SUM(venta * cantidad * valor) AS impuesto"), 
        DB::raw("SUM(venta * cantidad)+SUM(venta * cantidad * valor) AS total"))
        ->join('producto__vendidos', 'id_venta', '=', 'ventas.id')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->groupby('ventas.id')
        ->orderby('ventas.created_at')->get();

        $data = [
            'title' => 'Listado de ventas',
            'date' => date('m/d/Y'),
            'ventas' =>$ventas,
        ];
           
        $pdf =PDF::loadView('ventas/pdf', $data);
     
        return $pdf->download('Listado_de_venta_'.date('m_d_Y').'.pdf');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::select("compras.id", "id_proveedor", "compras.created_at", 
        DB::raw("SUM(venta* cantidad) AS subtotal"), DB::raw("SUM(venta * cantidad * valor) AS impuesto"), 
        DB::raw("SUM(venta* cantidad)+SUM(venta * cantidad * valor) AS total"))
        ->join('producto__vendidos', 'id_venta', '=', 'ventas.id')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->groupby('ventas.id')
        ->orderby('ventas.created_at')->get();

        return view('ventas/index')->with('ventas', $ventas);

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
        $temporalv = Producto_Temporalv::all();
        return view('ventas/create')->with('proveedors', $proveedors)
        ->with('prov', $prov)
        ->with('proveedor', $proveedor)
        ->with('productos', $productos)
        ->with('impuestos', $impuestos)
        ->with('temporalv', $temporalv)
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
        $venta = $request->input('venta')+0.01;

        $this->validate($request, [
            'productos' => 'required|exists:productos,id',
            "venta" => 'required|numeric|max:999999.99|min:',
            "cantidad" => "required|min:1|numeric|max:999999999",
            "impuesto" => "required|exists:impuestos,id",
        ], [
            'productos.required' => 'Debe de seleccionar un producto',
            'productos.exists' => 'El producto seleccionado es invalido',
            'venta.required' => 'El precio de venta es obligatorio',
            'venta.numeric' => 'El precio de venta es invalido',
            'venta.max' => 'El precio de venta ingresado es demasiado grande',
            'venta.min' => 'El precio de venta debe de ser mayor al precio de compra',
            'cantidad.required' => 'La cantidad es obligatorio',
            'cantidad.max' => 'La cantidad ingresada es demasiado grande',
            'cantidad.min' => 'La cantidad no puede ser negativa',
            'cantidad.numeric' => 'La cantidad debe de ser un valor numérico',
            'impuesto.required' => 'El impuesto es obligatorio',
            'impuesto.exists' => 'El impuesto seleccionado es invalido',
            
        ]);

        $verificar = Producto_Temporalv::where('id_producto', $request->input('productos'))->get();

        foreach($verificar as $v){
            $ver = $v->id;
        }

        if(isset($ver)){
            
            $productos = Producto_Temporalv::findOrFail($ver);

            $cantidadtotal = $productos->cantidad + $request->input('cantidad');
           // $valorventa = $productos->cantidad*$productos->compra + $request->input('cantidad')*$request->input('venta');//
            $valorventa = $productos->cantidad*$productos->venta + $request->input('cantidad')*$request->input('venta');

          
            $productos->venta = $valorventa/$cantidadtotal;
            $productos->cantidad = $cantidadtotal;
            $productos->id_impuesto = $request->input('impuesto');

            $creado = $productos->save();

            if ($creado) {
                return redirect()->route('ventas.create',['proveedor'=>$proveedor])
                ->with('mensaje', 'El producto fue actualizado exitosamente');
            }
            

        }else{
            $productos = new Producto_Temporalv();

            $productos->id_producto = $request->input('productos');
           // $productos->compra = $request->input('compra');
            $productos->venta = $request->input('venta');
            $productos->cantidad = $request->input('cantidad');
            $productos->id_impuesto = $request->input('impuesto');

            $creado = $productos->save();

            if ($creado) {
                return redirect()->route('ventas.create',['proveedor'=>$proveedor])->with('mensaje2', 'El producto fue agregado exitosamente');
            }

        }

    }

    public function cambiar($valor){

        $verifican = Producto_Temporalv::all();

        foreach($verifican as $verificar){
            $productos = new Producto_Vendido();

            $productos->id_producto = $verificar->id_producto;
            //$productos->compra = $verificar->compra;
            $productos->venta = $verificar->venta;
            $productos->cantidad = $verificar->cantidad;
            $productos->id_impuesto = $verificar->id_impuesto;
            $productos->id_venta = $valor;

            $creado = $productos->save();
        }
            $valor = 2;
            return $this->eliminartodo($valor);
    }

    public function save(Request $request,$proveedor){

        $venta = new Venta();

        $venta->id_proveedor = $proveedor;

        $creado = $venta->save();

        $this->cambiar($venta->id);

        return redirect()->route('ventas.create');
    }

    public function eliminar( $id, $proveedor){
        Producto_Temporalv::destroy($id);
        return redirect()->route('ventas.create',['proveedor'=>$proveedor])
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
        $val = Producto_Temporalv::all();
        
        foreach($val as $i){
            Producto_Temporalv::destroy($i->id);
        }
        

        if($valor == 0){
            return redirect()->route('ventas.create');
        }else{
            if($valor == 2){
                return redirect()->route('ventas.create')
                ->with('mensaje', 'La venta fue realizada exitosamente');
            }else{
                if($valor == 1){
                    return redirect()->route('ventas.index');
                }
            }
        }

    }

    public function show($id){
        $venta = Venta::findOrFail($id);
        $productos = Producto_Vendido::join('ventas','ventas.id','id_venta')
        ->where('id_venta', $id)->get();

        return view('ventas/show')->with('productos', $productos)->with('venta', $venta);
    }

}


