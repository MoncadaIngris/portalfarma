<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Producto_Temporal;
use App\Models\Producto_Vendido;
use App\Models\Impuesto;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($proveedor=0)
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
        ->with('temporal', $temporal);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $proveedor=0)
    {

        $this->validate($request, [
            'productos' => 'required|exists:productos,id',
            "venta" => 'required|numeric|max:999999.99|min:'.$request->input('compra'),
            "compra" => 'required|numeric|min:0',
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
            'compra.min' => 'El precio de compra no puede ser negativo',
            'compra.numeric' => 'El precio de compra es invalido',
            'cantidad.required' => 'La cantidad es obligatorio',
            'cantidad.max' => 'La cantidad ingresada es demasiado grande',
            'cantidad.min' => 'La cantidad no puede ser negativa',
            'cantidad.numeric' => 'La cantidad debe de ser un valor numérico',
            'impuesto.required' => 'El impuesto es obligatorio',
            'impuesto.exists' => 'El impuesto seleccionado es invalido',
            
        ]);

        $verificar = Producto_Temporal::find($request->input('productos'));

        if($verificar == null){

            $productos = new Producto_Temporal();

            $productos->id_producto = $request->input('productos');
            $productos->compra = $request->input('compra');
            $productos->venta = $request->input('venta');
            $productos->cantidad = $request->input('cantidad');
            $productos->id_impuesto = $request->input('impuesto');

            $creado = $productos->save();

        }else{

            $productos = Producto_Temporal::findOrFail($request->input('productos'));

            $cantidadtotal = $productos->cantidad + $request->input('cantidad');
            $valorcompra = $productos->cantidad*$productos->compra + $request->input('cantidad')*$request->input('compra');
            $valorventa = $productos->cantidad*$productos->venta + $request->input('cantidad')*$request->input('venta');

            $productos->compra = $valorcompra/$cantidadtotal;
            $productos->venta = $valorventa/$cantidadtotal;
            $productos->cantidad = $cantidadtotal;
            $productos->id_impuesto = $request->input('impuesto');

            $creado = $productos->save();

        }

        if ($creado) {
            return redirect()->route('compras.create',['proveedor'=>$proveedor]);
        }
    }

    public function cambiar($valor){

        $verifican = Producto_Temporal::all();

        foreach($verifican as $verificar){
            $productos = new Producto_Vendido();

            $productos->id_producto = $verificar->id_producto;
            $productos->compra = $verificar->compra;
            $productos->venta = $verificar->venta;
            $productos->cantidad = $verificar->cantidad;
            $productos->id_impuesto = $verificar->id_impuesto;
            $productos->id_compra = $valor;

            $creado = $productos->save();
        }
            $valor = 0;
            return $this->eliminartodo($valor);
    }

    public function save(Request $request,$proveedor){

        $compra = new Compra();

        $compra->id_proveedor = $proveedor;
        $compra->monto_total = $request->input('monto_total');

        $creado = $compra->save();

        $this->cambiar($compra->id);

        return redirect()->route('compras.create');
    }

    public function eliminar( $id, $proveedor){
        Producto_Temporal::destroy($id);
        return redirect()->route('compras.create',['proveedor'=>$proveedor]);
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
        $val = Producto_Temporal::count();
        
        for ($i=1; $i <= $val; $i++) { 
            Producto_Temporal::destroy($i);
        }

        if($valor == 0){
            return redirect()->route('compras.create');
        }else{

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompraRequest  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
