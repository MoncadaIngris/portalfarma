<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Producto_Vendido;
use App\Http\Requests\StoreProducto_VendidoRequest;
use App\Http\Requests\UpdateProducto_VendidoRequest;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use Illuminate\Database\Console\DbCommand;

class ProductoVendidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
        public function index(Request $request)
        {
    
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
            $val= $request->get('val');
    
            $fecha = Producto_Vendido::select(DB::raw("MIN(created_at) AS inicio,MAX(created_at) AS final"))->first();
    
            if($inicio == null){
                $inicio = date('Y-m-d',strtotime($fecha->inicio));
            }
    
            if($final == null){
                $final = date('Y-m-d',strtotime($fecha->final));
            }
    
    
          $ventas = Producto_Vendido::select("clientes.nombres","clientes.apellidos",DB::raw("SUM(producto__vendidos.venta*producto__vendidos.cantidad) as total"))
          ->join("ventas","ventas.id","=","producto__vendidos.id_venta")
          ->join("clientes","clientes.id","=","ventas.id_cliente")
          ->whereBetween('producto__vendidos.created_at', [$inicio." 00:00:00", $final." 23:59:59"])
          ->groupby("id_cliente")
          ->paginate(10);
    
          $ventas2 = Producto_Vendido::select("clientes.nombres","clientes.apellidos",DB::raw("SUM(producto__vendidos.venta*producto__vendidos.cantidad) as total"))
          ->join("ventas","ventas.id","=","producto__vendidos.id_venta")
          ->join("clientes","clientes.id","=","ventas.id_cliente")
          ->whereBetween('producto__vendidos.created_at', [$inicio." 00:00:00", $final." 23:59:59"])
          ->groupby("id_cliente")
          ->get();
    
            $puntos=[];
            foreach($ventas as $venta){
                $puntos [] = ['name' => $venta['nombres'] ,'y' => floatval($venta['total'])];
            }
    
            //
            $suma = 0;
    
            foreach($ventas as $p){
                $suma += $p->total;
            }
    
            if($suma == 0){
                $suma = 1;
            }
            //
    
            return view("graficos/graficoCliente",["data" => json_encode ($puntos)])
            ->with('ventas',$ventas)->with('ventas2',$ventas2)
            ->with('suma',$suma)
            ->with('val', $val)->with('inicio', $inicio)->with('final', $final);
         }



    
     





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function graficostore()
    {
        $ventas = Producto_Vendido::all();

        $puntos=[];
        foreach($ventas as $venta){
            $puntos [] = ['name' => $venta['id_venta'] ,'y' => floatval($venta['cantidad'])];
        }
        return view("graficos/graficoProducto",["data" => json_encode ($puntos)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProducto_VendidoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProducto_VendidoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto_Vendido  $producto_Vendido
     * @return \Illuminate\Http\Response
     */
    public function graficoshow()
    {
        $ventas = Producto_Vendido::all();

        $puntos=[];
        foreach($ventas as $venta){
            $puntos [] = ['name' => $venta['id_venta'] ,'y' => floatval($venta['cantidad'])];
        }
        return view("graficos/graficoProveedor",["data" => json_encode ($puntos)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto_Vendido  $producto_Vendido
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto_Vendido $producto_Vendido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProducto_VendidoRequest  $request
     * @param  \App\Models\Producto_Vendido  $producto_Vendido
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProducto_VendidoRequest $request, Producto_Vendido $producto_Vendido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto_Vendido  $producto_Vendido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto_Vendido $producto_Vendido)
    {
        //
    }
}
