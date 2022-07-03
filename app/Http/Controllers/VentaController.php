<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Producto_Temporalv;
use App\Models\Producto_vendido;
use App\Models\Compra;
use App\Models\Producto_Temporal;
use App\Models\Producto_Comprado;
use App\Models\Impuesto;
use App\Models\VencerEntrada;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Http\Controllers\raw;
use Illuminate\Support\Facades\Gate;
use PDF;


class VentaController extends Controller
{

    public function createPDF(){
        $ventas = Venta::select("ventas.id", "id_cliente", "ventas.created_at",
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

        abort_if(Gate::denies('ventas_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $ventas = Venta::select("ventas.id", "id_cliente", "ventas.created_at",
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
    public function create($cliente=0, $producto = " ", $producto_id=0)
    {
        abort_if(Gate::denies('ventas_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $clie = Cliente::find($cliente);
        $clientes = Cliente::all();
        $productos = Producto_Comprado::select("producto__comprados.id_producto as id", "productos.nombre", "productos.codigo", "productos.receta",
        DB::raw("sum(cantidad) AS cantidad"), DB::raw("IFNULL(nuevo,(SUM(venta*cantidad)/sum(cantidad))) AS venta"), 
        DB::raw("sum(cantidad*venta*(1+valor)) AS total"),DB::raw("max(impuestos.id) AS id_impuesto"))
        ->join('productos', 'productos.id', '=', 'producto__comprados.id_producto')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->leftjoin('promocions', 'promocions.id_producto', '=', 'producto__comprados.id_producto')
        ->groupby('producto__comprados.id_producto')
        ->orderby('productos.nombre')->get();
        $impuestos = Impuesto::all();
        $temporalv = Producto_Temporalv::all();
        return view('ventas/create')->with('clientes', $clientes)
        ->with('clie', $clie)
        ->with('cliente', $cliente)
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
    public function store(Request $request, $cliente=0)
    {
        abort_if(Gate::denies('ventas_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $datos = Producto_Comprado::select("producto__comprados.id_producto as id", "productos.nombre", "productos.codigo", 
        DB::raw("sum(producto__comprados.cantidad) AS cantidad"), 
        DB::raw("IFNULL(nuevo,(SUM(producto__comprados.venta*producto__comprados.cantidad)/sum(producto__comprados.cantidad))) AS venta"), 
        DB::raw("sum(producto__comprados.cantidad*producto__comprados.venta*(1+valor)) AS total"),DB::raw("max(impuestos.id) AS impuesto"))
        ->join('productos', 'productos.id', '=', 'producto__comprados.id_producto')
        ->join('impuestos', 'id_impuesto', '=', 'impuestos.id')
        ->leftjoin('promocions', 'promocions.id_producto', '=', 'producto__comprados.id_producto')
        ->where('productos.id',$request->input('productos'))
        ->groupby('producto__comprados.id_producto')
        ->orderby('productos.nombre')->get();

        $val2 = Producto_Temporalv::select(DB::raw("ISNULL(SUM(cantidad)) AS valor"))
        ->where('id_producto',$request->input('productos'))->first();

        $val3 = Producto_Vendido::select(DB::raw("ISNULL(SUM(cantidad)) AS valor"))
        ->where('id_producto',$request->input('productos'))->first();

        $can2 = 0;
        if($val2->valor == 0){
            $dato2 = Producto_Temporalv::select(DB::raw("SUM(cantidad) AS cantidad"))
            ->where('id_producto',$request->input('productos'))->first();

            $can2 = $dato2->cantidad;

        }

        $can3 = 0;
        if($val3->valor == 0){
            $dato3 = Producto_Vendido::select(DB::raw("SUM(cantidad) AS cantidad"))
            ->where('id_producto',$request->input('productos'))->first();

            $can3 = $dato3->cantidad;

        }

        $productos = new Producto_Temporalv();

        $cantidad = 0;

        foreach($datos as $d){
            $cantidad = ($d->cantidad)-$can2-$can3;
        }


        $this->validate($request, [
            'productos' => 'required|exists:productos,id',
            "cantidad" => "required|min:1|numeric|max:".$cantidad,
        ], [
            'productos.required' => 'Debe de seleccionar un producto',
            'productos.exists' => 'El producto seleccionado es invalido',
            'venta.required' => 'El precio de venta es obligatorio',
            'venta.numeric' => 'El precio de venta es invalido',
            'venta.max' => 'El precio de venta ingresado es mayor a la existencia',
            'venta.min' => 'El precio de venta debe de ser mayor al precio de compra',
            'cantidad.required' => 'La cantidad es obligatorio',
            'cantidad.max' => 'La cantidad ingresada es demasiado grande actualmente tiene en existencia '.$cantidad.' unidades de ese producto',
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
            $productos->cantidad = $cantidadtotal;
            foreach($datos as $dat){
                $productos->id_impuesto = $dat->impuesto;
            }

            $creado = $productos->save();

            if ($creado) {
                return redirect()->route('ventas.create',['cliente'=>$cliente])
                ->with('mensaje', 'El producto fue actualizado exitosamente');
            }


        }else{

            foreach($datos as $dat){
                $productos->id_producto = $request->input('productos');
                $productos->venta = $dat->venta;
                $productos->cantidad = $request->input('cantidad');
                $productos->id_impuesto = $dat->impuesto;
            }

            $creado = $productos->save();

            if ($creado) {
                return redirect()->route('ventas.create',['cliente'=>$cliente])->with('mensaje2', 'El producto fue agregado exitosamente');
            }

        }

    }

    public function cambiar($valor){

        $verifican = Producto_Temporalv::all();

        foreach($verifican as $verificar){
            $productos = new Producto_Vendido();

            $productos->id_producto = $verificar->id_producto;
            $productos->venta = $verificar->venta;
            $productos->cantidad = $verificar->cantidad;
            $productos->id_impuesto = $verificar->id_impuesto;
            $productos->id_venta = $valor;

            $creado = $productos->save();

            $vencimiento = VencerEntrada::select('vencer_entradas.id','vencer_entradas.cantidad','vencimiento')
            ->join('producto__comprados','producto__comprados.id','=','vencer_entradas.id_compra')
            ->where('id_producto',$verificar->id_producto)
            ->orderby('vencimiento','asc')
            ->first();

            if ($verificar->cantidad <=  $vencimiento->cantidad) {
                $venc = VencerEntrada::findOrFail($vencimiento->id);

                $venc->cantidad = $venc->cantidad -  $verificar->cantidad;

                $creado2 = $venc->save();
            } else {
                VencerEntrada::destroy($vencimiento->id);

                $vencimiento2 = VencerEntrada::select('vencer_entradas.id','vencer_entradas.cantidad','vencimiento')
                ->join('producto__comprados','producto__comprados.id','=','vencer_entradas.id_compra')
                ->where('id_producto',$verificar->id_producto)
                ->orderby('vencimiento','asc')
                ->first();

                $venc = VencerEntrada::findOrFail($vencimiento2->id);

                $cantidad = $verificar->cantidad- $vencimiento->cantidad;

                $venc->cantidad = $venc->cantidad -  $cantidad;

                $creado2 = $venc->save();
            }
            

        }
            $valor = 2;
            return $this->eliminartodo($valor);
    }

    public function save(Request $request,$cliente){

        $venta = new Venta();

        $venta->id_cliente = $cliente;

        $creado = $venta->save();

        $this->cambiar($venta->id);

        return redirect()->route('ventas.show',['id'=>$venta->id]);
    }

    public function eliminar( $id, $cliente){
        Producto_Temporalv::destroy($id);
        return redirect()->route('ventas.create',['cliente'=>$cliente])
        ->with('mensaje2', 'El producto fue eliminado exitosamente');
    }

    public function cancelar(){
        $valor = 1;
        return $this->eliminartodo($valor);
    }

    public function limpiar($cliente){
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
        abort_if(Gate::denies('ventas_detalle'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));


        $venta = Venta::findOrFail($id);
        $productos = Producto_Vendido::join('ventas','ventas.id','id_venta')
        ->where('id_venta', $id)->get();

        return view('ventas/show')->with('productos', $productos)->with('venta', $venta);
    }

//graficos

  

    public function grafico(Request $request) {
        abort_if(Gate::denies('grafico_fecha'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $rules=[
            'start_date' => 'nullable',
            'end_date'=>'nullable|after_or_equal:start_date',
        ];

        $mensaje=[
            'end_date.after_or_equal' => 'La fecha final no puede ser menor a la de inicio',
        ];

        

        $this->validate($request,$rules,$mensaje);

        $inicio = $request->input('start_date');
        $final = $request->input('end_date');

        $fecha = Producto_Vendido::select(DB::raw("MIN(created_at) AS inicio,MAX(created_at) AS final"))->first();

        if($inicio == null){
            $inicio = date('Y-m-d',strtotime($fecha->inicio));
        }

        if($final == null){
            $final = date('Y-m-d',strtotime($fecha->final));
        }

        $ventas = Producto_Vendido::select(DB::raw('DATE_FORMAT(created_at,"%Y %m") AS fecha, SUM(venta*cantidad) as total'))
        ->whereBetween('producto__vendidos.created_at', [$inicio." 00:00:00", $final." 23:59:59"])
        ->GROUPBY(DB::raw('DATE_FORMAT(created_at,"%Y %m")'))
        ->get();

                //
                $suma = 0;

                foreach($ventas as $p){
                    $suma += $p->total;
                }
        
                if($suma == 0){
                    $suma = 1;
                }
                //

        return view("graficos/graficoVentasPorFecha")->with('ventas', $ventas)
        ->with('inicio', $inicio)->with('final', $final)->with('suma', $suma);
    }




}


