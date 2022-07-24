<?php

namespace App\Http\Controllers;

use App\Models\Estante;
use App\Models\Fila;
use App\Models\Columna;
use App\Models\Producto;
use App\Models\ProductoUbicacion;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreEstanteRequest;
use App\Http\Requests\UpdateEstanteRequest;
use Illuminate\Http\Request;

class EstanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estantes = Estante::all();

        return view('estante/index')->with('estantes', $estantes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estante/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEstanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'nombres' => 'required|max:50|unique:estantes,nombre',
            'descripcion' => 'required|max:100',
            'fila' => 'required|numeric|min:0|max:100',
            'columna' => 'required|numeric|min:1|max:100',
        ];
        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'nombres.unique' => 'El nombre ya esta en uso',

            'descripcion.required' => 'La descripcion no puede estar vacío',
            'descripcion.max' => 'La descripcion es muy extensa',

            'fila.required' => 'El numero de fila no puede estar vacío',
            'fila.max' => 'El numero de fila es muy grande',
            'fila.min' => 'El numero de fila no puede ser menor a 1',
            'fila.numeric' => 'El numero de fila debe de ser un numero',

            'columna.required' => 'El numero de columna no puede estar vacío',
            'columna.max' => 'El numero de columna es muy grande',
            'columna.min' => 'El numero de columna no puede ser menor a 1',
            'columna.numeric' => 'El numero de columna debe de ser un numero',
        ];

        $this->validate($request,$rules,$mensaje);

        $estante = new Estante();

        $estante->nombre = $request->input('nombres');
        $estante->descripcion = $request->input('descripcion');
        $estante->fila = $request->input('fila');
        $estante->columna = $request->input('columna');

        $creado = $estante->save();

        //fila
        for ($i=1; $i <= $request->input('fila') ; $i++) { 
            $fila = new Fila();

            $fila->numero = $i;
            $fila->id_estante = $estante->id;
            $fila->save();
        }

        //columna
        for ($j=1; $j <= $request->input('columna') ; $j++) { 
            $columna = new Columna();

            $columna->numero = $j;
            $columna->id_estante = $estante->id;
            $columna->save();
        }

        return redirect()->route('estante.index')
                ->with('mensaje', 'El estante fue creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

        $estantes = Estante::findOrFail($id);
        return view("estante.update")->with("estante", $estantes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEstanteRequest  $request
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $rules=[
            'nombres' => 'required|max:50|unique:estantes,nombre,'.$id,
            'descripcion' => 'required|max:100',
            'fila' => 'required|numeric|min:0|max:100',
            'columna' => 'required|numeric|min:1|max:100',
        ];
        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'nombres.unique' => 'El nombre ya esta en uso',

            'descripcion.required' => 'La descripcion no puede estar vacío',
            'descripcion.max' => 'La descripcion es muy extensa',

            'fila.required' => 'El numero de fila no puede estar vacío',
            'fila.max' => 'El numero de fila es muy grande',
            'fila.min' => 'El numero de fila no puede ser menor a 1',
            'fila.numeric' => 'El numero de fila debe de ser un numero',

            'columna.required' => 'El numero de columna no puede estar vacío',
            'columna.max' => 'El numero de columna es muy grande',
            'columna.min' => 'El numero de columna no puede ser menor a 1',
            'columna.numeric' => 'El numero de columna debe de ser un numero',
        ];

        $this->validate($request,$rules,$mensaje);

        $estante = Estante::findOrFail($id);;

        $estante->nombre = $request->input('nombres');
        $estante->descripcion = $request->input('descripcion');
        $estante->fila = $request->input('fila');
        $estante->columna = $request->input('columna');

        $creado = $estante->save();
/*
        //fila
        for ($i=1; $i <= $request->input('fila') ; $i++) { 
            $fila = new Fila();

            $fila->numero = $i;
            $fila->id_estante = $estante->id;
            $fila->save();
        }

        //columna
        for ($j=1; $j <= $request->input('columna') ; $j++) { 
            $columna = new Columna();

            $columna->numero = $j;
            $columna->id_estante = $estante->id;
            $columna->save();
        }
*/
        return redirect()->route('estante.index')
                ->with('mensaje', 'El estante fue editado exitosamente');
    }


    public function listado($id)
    {
        $estantes = Estante::select('filas.id AS id','filas.numero AS fila', 'estantes.nombre AS estante')
        ->join('filas','estantes.id','=','filas.id_estante')
        ->where('estantes.id',$id)->get();

        $alternativo = Estante::select("productos.nombre", "filas.numero as fila","columnas.numero as columna")
        ->join("producto_ubicacions", "producto_ubicacions.id_estante", "=", "estantes.id")
        ->join("filas","filas.id", "=", "producto_ubicacions.id_fila")
        ->join("columnas","columnas.id", "=", "producto_ubicacions.id_columna")
        ->join("productos", "productos.id", "=", "producto_ubicacions.id_producto")
        ->where('estantes.id',$id)->get();

        return view('estante/listado')->with('estantes', $estantes)->with('alternativo', $alternativo);
    }

    public function columna($id)
    {
        $estantes = Estante::select('columnas.id AS id','columnas.numero AS columna',"estantes.id as id_fila",'estantes.nombre AS estante')
        ->join('columnas','estantes.id','=','columnas.id_estante')
        ->join('filas','estantes.id','=','filas.id_estante')
        ->where('filas.id',$id)->get();

        $alternativo = Estante::select("productos.nombre", "filas.numero as fila","columnas.numero as columna")
        ->join("producto_ubicacions", "producto_ubicacions.id_estante", "=", "estantes.id")
        ->join("filas","filas.id", "=", "producto_ubicacions.id_fila")
        ->join("columnas","columnas.id", "=", "producto_ubicacions.id_columna")
        ->join("productos", "productos.id", "=", "producto_ubicacions.id_producto")
        ->where('filas.id',$id)->get();

        return view('estante/columna')->with('estantes', $estantes)->with('alternativo', $alternativo);
    
    }

    public function asignar($id)
    {
        $estantes = Estante::select('columnas.id AS id','columnas.numero AS columna',"estantes.id as id_fila" ,'estantes.nombre AS estante')
        ->join('columnas','estantes.id','=','columnas.id_estante')
        ->join('filas','estantes.id','=','filas.id_estante')
        ->where('filas.id',$id)->get();

        $productos = Producto::all();

        
        $alternativo = Estante::select("productos.nombre","productos.id as producto_id", "filas.numero as fila","columnas.numero as columna")
        ->join("producto_ubicacions", "producto_ubicacions.id_estante", "=", "estantes.id")
        ->join("filas","filas.id", "=", "producto_ubicacions.id_fila")
        ->join("columnas","columnas.id", "=", "producto_ubicacions.id_columna")
        ->join("productos", "productos.id", "=", "producto_ubicacions.id_producto")
        ->where('filas.id',$id)->get();


        return view('estante/asignar')->with('estantes', $estantes)->with('productos', $productos)
        ->with('alternativo', $alternativo);
    }

    public function agregar(Request $request,$id)
    {
        $estantes = Estante::select('columnas.id AS id',
        'columnas.id AS columna', 
        'filas.id AS fila', 
        'estantes.id AS estante')
        ->join('columnas','estantes.id','=','columnas.id_estante')
        ->join('filas','estantes.id','=','filas.id_estante')
        ->where('filas.id',$id)->get();

        foreach ($estantes as $estante) {
            $product = new ProductoUbicacion();

            $product->id_estante = $estante->estante;
            $product->id_fila = $estante->fila;
            $product->id_columna = $estante->columna;
            $product->id_producto = $request->input('estante'.$estante->id);

            $creado3 = $product->save();
        }
        return redirect()->route('estante.columna',['id'=> $product->id_fila])
        ->with('mensaje', 'La asignacion fue creada exitosamente');
    }

    public function cambiar($id)
    {
        $estantes = Estante::select('columnas.id AS id','columnas.numero AS columna',"estantes.id as id_fila" ,'estantes.nombre AS estante')
        ->join('columnas','estantes.id','=','columnas.id_estante')
        ->join('filas','estantes.id','=','filas.id_estante')
        ->where('filas.id',$id)->get();

        $alternativo = Estante::select("productos.nombre","productos.id as producto_id", "filas.numero as fila","columnas.numero as columna")
        ->join("producto_ubicacions", "producto_ubicacions.id_estante", "=", "estantes.id")
        ->join("filas","filas.id", "=", "producto_ubicacions.id_fila")
        ->join("columnas","columnas.id", "=", "producto_ubicacions.id_columna")
        ->join("productos", "productos.id", "=", "producto_ubicacions.id_producto")
        ->where('filas.id',$id)->get();

        $productos = Producto::all();

        return view('estante/asignar')->with('estantes', $estantes)->with('productos', $productos)->with('alternativo', $alternativo);
    }

    public function cambio(Request $request,$id)
    {
        $estantes = Estante::select('columnas.id AS id',
        'columnas.id AS columna', 
        'filas.id AS fila', 
        'estantes.id AS estante')
        ->join('columnas','estantes.id','=','columnas.id_estante')
        ->join('filas','estantes.id','=','filas.id_estante')
        ->where('filas.id',$id)->get();

        foreach ($estantes as $estante) {
            $product = ProductoUbicacion::where("id_estante",$estante->estante)->where("id_fila",$estante->fila)
            ->where("id_columna",$estante->columna)->first();

            $product->id_producto = $request->input('estante'.$estante->id);

            $product->save();
        }
        return redirect()->route('estante.columna',['id'=> $product->id_fila])
        ->with('mensaje', 'La asignacion fue creada exitosamente');
    }

}
