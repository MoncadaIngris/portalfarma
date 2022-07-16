<?php

namespace App\Http\Controllers;

use App\Models\Estante;
use App\Models\Fila;
use App\Models\Columna;
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
     * Display the specified resource.
     *
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function show(Estante $estante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estante $estante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEstanteRequest  $request
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstanteRequest $request, Estante $estante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estante $estante)
    {
        //
    }
}
