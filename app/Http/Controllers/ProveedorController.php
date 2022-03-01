<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;



class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedor = Proveedor::where('estado',0)->select("id","nombre_repartidor", "telefono_repartidor", "nombre_proveedor", "dia_de_entrega")->get();
        $provee = Proveedor::where('estado',0)->get();

        return view('proveedor/index')->with('proveedor', $proveedor)->with('provee', $provee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($prov=-1)
    {
        return view('proveedor/create')->with('prov', $prov);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProveedorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $prov=-1)
    {
        $rules=[
            'nombre_repartidor' => 'required|max:100',
            'nombre_proveedor' => 'required|max:100|unique:proveedors,nombre_proveedor',
            'correo_electronico' => 'required|max:100|email|unique:proveedors,correo_electronico',
            'telefono_repartidor'=> 'required|unique:proveedors,telefono_repartidor|numeric|regex:([9,8,3,2]{1}[0-9]{7})',
            'telefono_proveedor'=> 'required|unique:proveedors,telefono_proveedor|numeric|regex:([9,8,3,2]{1}[0-9]{7})',
            'dia_de_entrega' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
        ];

        $mensaje=[
            'nombre_repartidor.required' => 'El nombre del repartidor no puede ser vacío',
            'nombre_repartidor.max' => 'El nombre del repartidor es muy extenso',
            'nombre_proveedor.unique' => 'El nombre del proveedor ya esta en uso',
            'nombre_proveedor.required' => 'El nombre del proveedor no puede ser vacío',
            'nombre_proveedor.max' => 'El nombre del proveedor es muy extenso',
            'correo_electronico.required' => 'El correo electrónico no puede ser vacío',
            'correo_electronico.regex' => 'El correo electrónico tiene un formato invalido',
            'correo_electronico.max' => 'El correo electrónico es muy extenso',
            'correo_electronico.email' => 'En correo electrónico debe de ingresar un correo valido',
            'correo_electronico.unique' => 'El correo electrónico ya esta en uso',
            'telefono_repartidor.required' => 'El de teléfono del repartidor no puede ser vacío',
            'telefono_repartidor.regex' => 'El teléfono del repartidor debe contener 8 dígitos',
            'telefono_repartidor.numeric' => 'El teléfono del repartidor debe de ser números',
            'telefono_repartidor.unique' => 'El teléfono del repartidor ya esta en uso',
            'telefono_proveedor.required' => 'El de teléfono del proveedor no puede ser vació',
            'telefono_proveedor.regex' => 'El teléfono del proveedor debe contener 8 dígitos',
            'telefono_proveedor.numeric' => 'El teléfono del proveedor debe de ser números',
            'telefono_proveedor.unique' => 'El teléfono del proveedor ya esta en uso',
            'dia_de_entrega.required' => 'El dia de entrega es obligatorio',
            'dia_de_entrega.in' => 'El dia de entrega no es valido',
        ];

        $this->validate($request,$rules,$mensaje);

        $proveedor = new Proveedor();

        $proveedor->nombre_repartidor = $request->input('nombre_repartidor');
        $proveedor->nombre_proveedor= $request->input('nombre_proveedor');
        $proveedor->correo_electronico = $request->input('correo_electronico');
        $proveedor->telefono_repartidor= $request->input('telefono_repartidor');
        $proveedor->telefono_proveedor = $request->input('telefono_proveedor');
        $proveedor->dia_de_entrega= $request->input('dia_de_entrega');

        $creado = $proveedor->save();

        if ($creado) {
            if ($prov != -1){
                return redirect()->route('compras.create',["proveedor"=>$proveedor->id])
                ->with('mensaje', 'El proveedor fue creado exitosamente');
            }else{
                return redirect()->route('proveedor.index')
                ->with('mensaje', 'El proveedor fue creado exitosamente');
            }
        } else {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        {
            $proveedor = Proveedor::findOrFail($id);
            return view("proveedor.show")->with("proveedor", $proveedor);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $proveedor = Proveedor::findOrFail($id);
            return view("proveedor.update")->with("proveedor", $proveedor);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProveedorRequest  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */

        public function update(UpdateProveedorRequest $request, $id)
    {
        $rules=[
            'nombre_repartidor' => 'required|max:100',
            'nombre_proveedor' => 'required|max:100|unique:proveedors,nombre_proveedor,'.$id,
            'correo_electronico' => 'required|max:100|email|unique:proveedors,correo_electronico,'.$id,
            'telefono_repartidor'=> 'required|numeric|regex:([9,8,3,2]{1}[0-9]{7})|unique:proveedors,telefono_repartidor,'.$id,
            'telefono_proveedor'=> 'required|numeric|regex:([9,8,3,2]{1}[0-9]{7})|unique:proveedors,telefono_proveedor,'.$id,
            'dia_de_entrega' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
        ];

        $mensaje=[
            'nombre_repartidor.required' => 'El nombre del repartidor no puede ser vacío',
            'nombre_repartidor.max' => 'El nombre del repartidor es muy extenso',
            'nombre_proveedor.required' => 'El nombre del proveedor no puede ser vacío',
            'nombre_proveedor.unique' => 'El nombre del proveedor ya esta en uso',
            'nombre_proveedor.max' => 'El nombre del proveedor es muy extenso',
            'correo_electronico.required' => 'El correo electrónico no puede ser vacío',
            'correo_electronico.regex' => 'El correo electrónico tiene un formato invalido',
            'correo_electronico.max' => 'El correo electrónico es muy extenso',
            'correo_electronico.email' => 'En correo electrónico debe de ingresar un correo valido',
            'correo_electronico.unique' => 'El correo electrónico ya esta en uso',
            'telefono_repartidor.required' => 'El de teléfono del repartidor no puede ser vacío',
            'telefono_repartidor.regex' => 'El teléfono del repartidor debe contener 8 dígitos',
            'telefono_repartidor.numeric' => 'El teléfono del repartidor debe de ser números',
            'telefono_repartidor.unique' => 'El teléfono del repartidor ya esta en uso',
            'telefono_proveedor.required' => 'El de teléfono del proveedor no puede ser vació',
            'telefono_proveedor.regex' => 'El teléfono del proveedor debe contener 8 dígitos',
            'telefono_proveedor.numeric' => 'El teléfono del proveedor debe de ser números',
            'telefono_proveedor.unique' => 'El teléfono del proveedor ya esta en uso',
            'dia_de_entrega.required' => 'El dia de entrega es obligatorio',
            'dia_de_entrega.in' => 'El dia de entrega no es valido',
        ];


        $proveedor= Proveedor::findOrFail($id);

        $proveedor->nombre_repartidor = $request->input('nombre_repartidor');
        $proveedor->nombre_proveedor= $request->input('nombre_proveedor');
        $proveedor->correo_electronico = $request->input('correo_electronico');
        $proveedor->telefono_repartidor= $request->input('telefono_repartidor');
        $proveedor->telefono_proveedor = $request->input('telefono_proveedor');
        $proveedor->dia_de_entrega= $request->input('dia_de_entrega');

        $creado = $proveedor->save();

        if ($creado) {
            return redirect()->route('proveedor.index')
                ->with('mensaje', 'El proveedor fue editado exitosamente');
        } else {

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }


    // funcion para lista de desact
    public function desactivados()
    {
        $proveedor = Proveedor::where('estado',1)->select("id","nombre_repartidor", "telefono_repartidor", "nombre_proveedor", "dia_de_entrega")->get();
        $provee = Proveedor::where('estado',1)->get();
        return view('proveedor/desactivados')->with('proveedor',$proveedor)->with('provee', $provee);
    }
// funcion para activar 
    public function activar(UpdateProveedorRequest $request, $id)
    {

        $proveedor= Proveedor::findOrFail($id);
        $proveedor->estado= 0;

        $creado = $proveedor->save();

        return redirect()->route('proveedor.desactivado');
    }

    // funcion para desactivar 
    public function desactivar(UpdateProveedorRequest $request, $id)
    {

        $proveedor= Proveedor::findOrFail($id);
        $proveedor->estado= 1;

        $creado = $proveedor->save();

        return redirect()->route('proveedor.index');
    }



}
