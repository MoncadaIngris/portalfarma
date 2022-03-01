<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Concentracion;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $productos = Producto::select("id","nombre", "codigo", "concentracion","receta")->orderby('nombre')->get();

            return view('productos/index')->with('productos', $productos);

        }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($prov=-1)
    {
        $concentracion = Concentracion::all();
        return view('productos/create')->with('concentracion', $concentracion)->with('prov', $prov);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $prov=-1)
    {
            $rules=[
                'nombre' => 'required|max:50|unique:productos,nombre',
                'codigo' => 'required|numeric|regex:([0-9]{8})|unique:productos,codigo',
                'concentracion' => 'required|exists:concentracions,id',
                'receta'=> 'required|in:0,1',
                'descripcion'=> 'required|max:200',



        ];
        $mensaje=[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.unique' => 'El nombre ya esta en uso',
            'nombre.max' => 'El nombre es muy extenso',
            'codigo.required' => 'El código no puede estar vacío',
            'codigo.unique' => 'El código ya esta en uso',
            'codigo.regex' => 'El codigo debe contener 8 dígitos ',
            'codigo.numeric' => 'En codigo no debe de incluir letras ni signos',
            'concentracion.required' => 'La concentración no puede estar vacío',
            'concentracion.exists' => 'La concentración es invalida',
            'receta.required' => 'La receta no puede estar vacío',
            'receta.in' => 'La receta es invalida',
            'descripcion.required' => 'El descripción no puede estar vacío',
            'descripcion.max' => 'El descripción es muy extensa',




        ];

        $this->validate($request,$rules,$mensaje);

        $producto = new Producto();

        $producto->nombre = $request->input('nombre');
        $producto->codigo= $request->input('codigo');
        $producto->concentracion = $request->input('concentracion');
        $producto->receta= $request->input('receta');
        $producto->descripcion = $request->input('descripcion');

        $creado =  $producto->save();

        if ($creado) {
            if ($prov != -1){
                return redirect()->route('compras.create',["proveedor"=>$prov, "producto"=>$producto->nombre, "producto_id"=>$producto->id])
                ->with('mensaje2', 'El producto fue creado exitosamente');
            }else{
                return redirect()->route('productos.index')
                ->with('mensaje', 'El producto fue agregado exitosamente');
            }
        } else {

        }

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        {
            $productos = Producto::findOrFail($id);
            return view("productos.show")->with("productos", $productos);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductoRequest  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
