<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Producto_Temporal;
use App\Models\Producto_Comprado;
use App\Models\Impuesto;
use App\Models\VencerEntrada;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use Illuminate\Support\Facades\Gate;
use PDF;

class CompraController extends Controller
{

    public function createPDF(){
        $compras = Compra::select("compras.id", "id_proveedor", "compras.created_at", 
        DB::raw("SUM(compra * cantidad) AS subtotal"), DB::raw("SUM(compra * cantidad * valor) AS impuesto"), 
        DB::raw("SUM(compra * cantidad)+SUM(compra * cantidad * valor) AS total"))
        ->join('producto__comprados', 'id_compra', '=', 'compras.id')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->groupby('compras.id')
        ->orderby('compras.created_at')->get();

        $data = [
            'title' => 'Listado de compras',
            'date' => date('m/d/Y'),
            'compras' =>$compras,
        ];
           
        $pdf = PDF::loadView('compras/pdf', $data);
     
        return $pdf->download('Listado_de_compra_'.date('m_d_Y').'.pdf');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('compras_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

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
    public function create(Request $request,$proveedor=0, $producto = " ", $producto_id=0)
    {
        abort_if(Gate::denies('compras_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));
        $productoseleccionado = $request->get('producto');
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
        ->with('producto_id', $producto_id)
        ->with('productoseleccionado', $productoseleccionado);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $proveedor=0)
    {
        abort_if(Gate::denies('compras_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $compra = $request->input('compra')+0.01;

        $fecha_actual = date("d-m-Y");
        $max = date('d-m-Y',strtotime($fecha_actual."- 18 year"));
        $maxima = date("d-m-Y",strtotime($max."+ 30 days"));

        $this->validate($request, [
            'productos' => 'required|exists:productos,id',
            "venta" => 'required|numeric|max:999999.99|min:'.$compra,
            "compra" => 'required|numeric|min:1',
            "cantidad" => "required|min:1|numeric|max:999999999",
            "impuesto" => "required|exists:impuestos,id",
            "vencimiento" => "required|date|after:'.$maxima.",
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
            'vencimiento.required' => 'La fecha de vencimiento es obligatorio',
            'vencimiento.date' => 'La fecha de vencimiento debe de ser una fecha',
            'vencimiento.after' => 'La fecha de vencimiento debe de ser '.$maxima.' o mayor ',
            
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
            $productos->vencimiento = $request->input('vencimiento');

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
            $productos->vencimiento = $request->input('vencimiento');

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

            $corregir = Producto_Comprado::where('id_producto', $verificar->id_producto)->get();

            foreach($corregir as $c){
                $corr = Producto_Comprado::findOrFail($c->id);
                $corr->id_impuesto = $verificar->id_impuesto;
                $cread = $corr->save();
            }

            $vencimiento = new VencerEntrada();
            $vencimiento->cantidad = $verificar->cantidad;
            $vencimiento->vencimiento = $verificar->vencimiento;
            $vencimiento->id_compra = $productos->id;
            $creado2 = $vencimiento->save();
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
                if($valor == 1){
                    return redirect()->route('compras.index');
                }
            }
        }

    }

    public function show($id){
        abort_if(Gate::denies('compras_detalle'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $compra = Compra::findOrFail($id);
        $productos = Producto_Comprado::join('compras','compras.id','id_compra')
        ->where('id_compra', $id)->get();

        return view('compras/show')->with('productos', $productos)->with('compra', $compra);
    }

}
