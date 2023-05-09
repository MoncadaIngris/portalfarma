<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('clientes_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));
        $clientes = Cliente::select("id","nombres", "apellidos", "DNI","telefono")->get();

        return view('clientes/index')->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($clie=-1)
    {
        abort_if(Gate::denies('clientes_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        return view('clientes/create')->with('clie', $clie);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$clie=-1)
    {
        abort_if(Gate::denies('clientes_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $rules=[
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'personal'=> 'required|unique:clientes,telefono|numeric|regex:([9,8,3,2]{1}[0-9]{7})',
            'dni'=> 'required|unique:clientes,DNI|numeric|regex:([0-1]{1}[0-9]{1}[0-2]{1}[0-8]{1}[0-9]{9})',
            'direccion'=>'required|max:200|regex:/^[a-zA-Z0-9\s]*[a-zA-Z][a-zA-Z0-9\s]*$/',
        ];

        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'apellidos.required' => 'El apellido no puede estar vacío',
            'apellidos.max' => 'El apellido es muy extenso',
            'personal.required' => 'El teléfono no puede estar vacío',
            'personal.regex' => 'El teléfono debe contener 8 dígitos e iniciar con 2,3,8 o 9',
            'personal.numeric' => 'En teléfono no debe de incluir letras ni signos',
            'personal.unique' => 'El teléfono ingresado ya esta en uso',
            'dni.required' => 'La identidad no puede estar vacía',
            'dni.regex' => 'El formato de la identidad no es valida',
            'dni.numeric' => 'La identidad debe de ser números',
            'dni.unique' => 'La identidad ya esta en uso',
            'direccion.required' => 'La dirección no puede ser vacía',
            'direccion.max' => 'La dirección es muy extenso',
        ];

        $this->validate($request,$rules,$mensaje);

        $cliente = new Cliente();

        $cliente->nombres = $request->input('nombres');
        $cliente->apellidos= $request->input('apellidos');
        $cliente->telefono= $request->input('personal');
        $cliente->direccion = $request->input('direccion');
        $cliente->DNI= $request->input('dni');

        $creado = $cliente->save();

        if ($creado) {

            if ($clie != -1){
                return redirect()->route('ventas.create',["cliente"=>$cliente->id])
                ->with('mensaje', 'El cliente fue creado exitosamente');
            }else{
                return redirect()->route('clientes.index')
                ->with('mensaje', 'El cliente fue añadido exitosamente');
            }
        } else {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        abort_if(Gate::denies('clientes_detalle'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $clientes = Cliente::findOrFail($id);
            return view("clientes.show")->with("clientes", $clientes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('clientes_editar'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $clientes = Cliente::findOrFail($id);
        return view("clientes.update")->with("clientes", $clientes);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        abort_if(Gate::denies('clientes_editar'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $rules=[
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'personal'=> 'required|numeric|regex:([9,8,3,2]{1}[0-9]{7})|unique:clientes,telefono,'.$id,
            "dni" => "required|numeric|regex:([0-1]{1}[0-8]{1}[0-2]{1}[0-8]{1}[0-9]{9})|unique:clientes,dni," . $id,
            'direccion'=>'required|max:200|regex:/^[a-zA-Z0-9\s]*[a-zA-Z][a-zA-Z0-9\s]*$/',
        ];

        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'apellidos.required' => 'El apellido no puede estar vacío',
            'apellidos.max' => 'El apellido es muy extenso',
            'personal.required' => 'El teléfono no puede estar vacío',
            'personal.regex' => 'El teléfono debe contener 8 dígitos e iniciar con 2,3,8 o 9',
            'personal.numeric' => 'En teléfono no debe de incluir letras ni signos',
            'personal.unique' => 'El teléfono ingresado ya esta en uso',
            'dni.required' => 'La identidad no puede estar vacía',
            'dni.regex' => 'El formato de la identidad no es valida',
            'dni.numeric' => 'La identidad debe de ser números',
            'dni.unique' => 'La identidad ya esta en uso',
            'direccion.required' => 'La dirección no puede ser vacía',
            'direccion.max' => 'La dirección es muy extenso',
        ];

        $this->validate($request,$rules,$mensaje);

        $cliente = Cliente::findOrFail($id);

        $cliente->nombres = $request->input('nombres');
        $cliente->apellidos= $request->input('apellidos');
        $cliente->telefono= $request->input('personal');
        $cliente->direccion = $request->input('direccion');
        $cliente->DNI= $request->input('dni');

        $creado = $cliente->save();

        if ($creado) {
            return redirect()->route('clientes.index')
                ->with('mensaje', 'El cliente fue editado exitosamente');
        } 

    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
