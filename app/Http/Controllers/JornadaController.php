<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use App\Http\Requests\StoreJornadaRequest;
use App\Http\Requests\UpdateJornadaRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class JornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('jornada_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $jornadas = Jornada::all();

        return view('jornada/index')->with('jornadas', $jornadas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('jornada_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        return view('jornada/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJornadaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('jornada_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $rules=[
            'nombres' => 'required|max:100',
            'entrada' => 'required',
            'salida' => 'required',
        ];

        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'entrada.required' => 'La hora entrada no puede estar vacío',
            'salida.required' => 'La hora salida no puede estar vacío',
        ];

        $this->validate($request,$rules,$mensaje);

        $jornada = new Jornada();

        $jornada->nombre = $request->input('nombres');
        $jornada->hora_entrada= $request->input('entrada');
        $jornada->hora_salida = $request->input('salida');

        $creado = $jornada->save();

        if ($creado) {
            return redirect()->route('jornada.index')
                ->with('mensaje', 'La jornada fue creada exitosamente');
        } else {

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function show(Jornada $jornada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function edit(Jornada $jornada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJornadaRequest  $request
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJornadaRequest $request, Jornada $jornada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jornada $jornada)
    {
        //
    }
}
