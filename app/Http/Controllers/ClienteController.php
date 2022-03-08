<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
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
        $clientes = Cliente::select("id","nombres", "apellidos", "DNI","telefono")->get();

        return view('clientes/index')->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'personal'=> 'required|unique:clientes,telefono|numeric|regex:([9,8,3,2]{1}[0-9]{7})',
            'dni'=> 'required|unique:clientes,DNI|numeric|regex:([0-1]{1}[0-9]{1}[0-2]{1}[0-8]{1}[0-9]{9})',
            'direccion'=>'required|max:200',
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
            return redirect()->route('clientes.index')
                ->with('mensaje', 'El cliente fue añadido exitosamente');
        } else {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        //
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
