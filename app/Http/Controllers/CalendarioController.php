<?php

namespace App\Http\Controllers;

use App\Models\Calendario;
use App\Models\Calendario_detalle;
use App\Models\Semana;
use App\Models\Empleado;
use App\Models\Jornada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCalendarioRequest;
use App\Http\Requests\UpdateCalendarioRequest;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('calendario_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $calendarios= Calendario::orderby('id_semana','desc')->get();

        return view('calendario/index')->with('calendarios', $calendarios);
    }
  




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('calendario_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $semana = Semana::select(DB::raw('DATE_ADD(MAX(fecha_final), INTERVAL 1 DAY) AS fecha_inicio, DATE_ADD(MAX(fecha_final), INTERVAL 7 DAY) AS fecha_final'))
        ->first();

        $empleados = Empleado::where('estado',0)->where('id','>',1)->select("id","nombres", "apellidos", "DNI")->get();

        $jornada = Jornada::all();

        return view('calendario/create')->with('semana', $semana)->with('empleados', $empleados)->with('jornadas', $jornada);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCalendarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('calendario_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $empleados = Empleado::where('estado',0)->where('id','>',1)->select("id","nombres", "apellidos", "DNI")->get();

        $semana = new Semana();
        $semana->fecha_inicio = $request->input('fecha_inicio');
        $semana->fecha_final= $request->input('fecha_final');
        $creado = $semana->save();

        if ($creado) {
            $calendario = new Calendario();

            $calendario->id_semana = $semana->id;

            $creado2 = $calendario->save();

            if ($creado2) {
                foreach ($empleados as $empleado) {
                    $detalle = new Calendario_detalle();

                    $detalle->id_empleado = $empleado->id;
                    $detalle->id_calendario = $calendario->id;
                    $detalle->id_jornada = $request->input('jornada'.$empleado->id);

                    $creado3 = $detalle->save();
                }
                return redirect()->route('calendario.index')
                ->with('mensaje', 'El calendario fue creada exitosamente');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function show(Calendario $calendario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('calendario_editar'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $calendarios = Calendario::findOrFail($id);
        $empleados = Calendario_detalle::where('id_calendario', $calendarios->id)->get();
        $jornada = Jornada::all();
        return view("Calendario.update")
        ->with("calendario", $calendarios)
        ->with("empleados", $empleados)
        ->with("jornadas", $jornada);
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('calendario_editar'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $calendarios = Calendario::findOrFail($id);
        $empleados = Calendario_detalle::where('id_calendario', $calendarios->id)->get();

        foreach ($empleados as $empleado) {
            $detalle = Calendario_detalle::findOrFail($empleado->id);

            $detalle->id_jornada = $request->input('jornada'.$detalle->id_empleado);

            $creado = $detalle->save();
        }
        if ($creado) {
            return redirect()->route('calendario.index')
            ->with('mensaje', 'El calendario fue editado exitosamente');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendario $calendario)
    {
        //
    }
}
