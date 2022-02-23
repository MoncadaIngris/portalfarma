<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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
        
            $productos = Producto::select("nombre", "codigo", "concentracion","receta")->get();
           
            return view('productos/index')->with('productos', $productos);
    
        }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $rules=[
            'nombre' => 'required|max:100',
            'codigo' => 'required|numeric|regex:([0-9])' ,
            'codigo' => 'required|max:8|',
            'concentracion' => 'required|max:100',
            'receta'=> 'required|max:200',
            'precio'=> 'required',
            'cantidad'=>'required',
          
        ];

        $mensaje=[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.max' => 'El nombre es muy extenso',
            'codigo.required' => 'El codigo no puede estar vacío',
            'codigo.max' => 'El codigo es muy extenso',
            'codigo.regex' => 'El codigo debe contener 8 dígitos ',
            'codigo.numeric' => 'En codigo no debe de incluir letras ni signos',
            'concentracion.required' => 'La concentracion no puede estar vacío',
            'concentracion.max' => 'La concentracion es muy extensa',
            'receta.required' => 'La receta no puede estar vacío',
            'receta.max' => 'La receta es muy extensa',
            'precio.required' => 'El precio no puede estar vacío',
            'cantidad.required' => 'La cantidad no puede estar vacío',


        ];

        $this->validate($request,$rules,$mensaje);

        $producto = new Producto();

        $producto->nombre = $request->input('nombre');
        $producto->codigo= $request->input('codigo');
        $producto->concentracion = $request->input('concentracion');
        $producto->receta= $request->input('receta');
        $producto->precio = $request->input('precio');
        $producto->cantidad= $request->input('cantidad');
        
        



        $creado =  $producto->save();

        if ($creado) {
            return redirect()->route('productos.index')
                ->with('mensaje', 'El producto fue agregado exitosamente');
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
    public function show(Producto $producto)
    {
        //
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
