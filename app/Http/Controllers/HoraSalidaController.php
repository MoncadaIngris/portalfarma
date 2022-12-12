<?php

namespace App\Http\Controllers;

use App\Models\Hora_salida;
use Illuminate\Http\Request;
use App\Models\Laboral;
use App\Http\Requests\StoreHora_salidaRequest;
use App\Http\Requests\UpdateHora_salidaRequest;

class HoraSalidaController extends Controller
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
    public function create($id)
    {
        $laborales= Laboral::findOrFail($id);
        return view("laboral.horasalida")->with("laboral", $laborales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHora_salidaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $rules=[
            'salida' => 'required'
        ];

        $mensaje=[
            'salida.required' => 'La hora salida no puede estar vacío'
        ];

        $this->validate($request,$rules,$mensaje);

        $salida = new Hora_salida();
        $salida->hora = $request->input('salida');;
        $creado = $salida->save();

        $laborales= Laboral::findOrFail($id);
        $laborales->id_hs = $salida->id;
        $creado2 = $laborales->save();

        if ($creado && $creado2) {
            return redirect()->route('laborales.index')->with('mensaje', 'La hora de salida fue agregada exitosamente');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hora_salida  $hora_salida
     * @return \Illuminate\Http\Response
     */
    public function show(Hora_salida $hora_salida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hora_salida  $hora_salida
     * @return \Illuminate\Http\Response
     */
    public function edit(Hora_salida $hora_salida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHora_salidaRequest  $request
     * @param  \App\Models\Hora_salida  $hora_salida
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHora_salidaRequest $request, Hora_salida $hora_salida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hora_salida  $hora_salida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hora_salida $hora_salida)
    {
        //
    }
}
