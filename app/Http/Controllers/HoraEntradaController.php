<?php

namespace App\Http\Controllers;

use App\Models\Hora_entrada;
use App\Models\Laboral;
use App\Http\Requests\StoreHora_entradaRequest;
use App\Http\Requests\UpdateHora_entradaRequest;
use Illuminate\Http\Request;

class HoraEntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $laborales= Laboral::findOrFail($id);
        return view("laboral.horaentrada")->with("laboral", $laborales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHora_entradaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $rules=[
            'entrada' => 'required'
        ];

        $mensaje=[
            'entrada.required' => 'La hora entrada no puede estar vacío'
        ];

        $this->validate($request,$rules,$mensaje);

        $entrada = new Hora_entrada();
        $entrada->hora = $request->input('entrada');;
        $creado = $entrada->save();

        $laborales= Laboral::findOrFail($id);
        $laborales->id_he = $entrada->id;
        $creado2 = $laborales->save();

        if ($creado && $creado2) {
            return redirect()->route('laborales.index')
                ->with('mensaje', 'La hora de entrada fue agregada exitosamente');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hora_entrada  $hora_entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Hora_entrada $hora_entrada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hora_entrada  $hora_entrada
     * @return \Illuminate\Http\Response
     */
    public function edit(Hora_entrada $hora_entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHora_entradaRequest  $request
     * @param  \App\Models\Hora_entrada  $hora_entrada
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHora_entradaRequest $request, Hora_entrada $hora_entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hora_entrada  $hora_entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hora_entrada $hora_entrada)
    {
        //
    }
}
