<?php

namespace App\Http\Controllers;

use App\Models\Vacaciones;
use App\Models\Empleado;
use App\Models\VacacionesPasadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreVacacionesRequest;
use App\Http\Requests\UpdateVacacionesRequest;

class VacacionesController extends Controller
{
    public function historico()
    {
        $empleados = Empleado::select("empleados.id","nombres", "apellidos", "DNI","telefono_personal","correo_electronico","inicio","final")
        ->join("vacaciones_pasadas","vacaciones_pasadas.id_empleado","=","empleados.id")
        ->get();

        return view('vacaciones/historia')->with('empleados', $empleados);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::select("empleados.id","nombres", "apellidos", "DNI","telefono_personal","correo_electronico","vacaciones.inicio","vacaciones.final",DB::raw("TIMESTAMPDIFF(DAY, inicio, final) AS dias"))
        ->join("vacaciones","vacaciones.id_empleado","=","empleados.id")
        ->get();

        return view('vacaciones/index')->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $empleado= Empleado::findOrFail($id);
        return view("vacaciones.create")->with("empleado", $empleado);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVacacionesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $fecha_actual = date("d-m-Y");
        $maxima = date('d-m-Y',strtotime($request->input('inicio')."+ 30 day"));
        $maxima2 = date("d-m-Y",strtotime($request->input('final')."- 1 day"));
        $minima = date("d-m-Y",strtotime($fecha_actual));
        $minima2 = date("d-m-Y",strtotime($request->input('inicio')."+ 1 day"));

        $rules=[
            'inicio'=>'required|date|before:'.$maxima2.'|after:'.$minima,
            'final'=>'required|date|before:'.$maxima.'|after:'.$minima2,
        ];

        $mensaje=[
            'inicio.required' => 'La fecha de inicio no puede estar vacía',
            'inicio.date' => 'La fecha de inicio debe de ser una fecha valida',
            'inicio.before' => 'La fecha de inicio debe de ser anterior a '.$maxima2,
            'inicio.after' => 'La fecha de inicio debe de ser posterior a '.$minima,
            'final.required' => 'La fecha de final no puede estar vacía',
            'final.date' => 'La fecha de final debe de ser una fecha valida',
            'final.before' => 'La fecha de final debe de ser anterior a '.$maxima,
            'final.after' => 'La fecha de final debe de ser posterior a '.$minima2,
        ];

        $this->validate($request,$rules,$mensaje);

        $vacaciones = new Vacaciones();
        $vacaciones->id_empleado = $id;
        $vacaciones->inicio= $request->input('inicio');
        $vacaciones->final = $request->input('final');
        $creado = $vacaciones->save();

        return redirect()->route('empleados.index')
                ->with('mensaje', 'El empleado se le asignaron vacaciones exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacaciones  $vacaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Vacaciones $vacaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacaciones  $vacaciones
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleados = Empleado::select("empleados.id","nombres", "apellidos", "DNI","telefono_personal","correo_electronico","vacaciones.inicio","vacaciones.final")
        ->join("vacaciones","vacaciones.id_empleado","=","empleados.id")
        ->where("empleados.id","=",$id)
        ->first();

        return view('vacaciones/edit')->with('empleado', $empleados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVacacionesRequest  $request
     * @param  \App\Models\Vacaciones  $vacaciones
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $fecha_actual = date("d-m-Y");
        $maxima = date('d-m-Y',strtotime($request->input('inicio')."+ 30 day"));
        $maxima2 = date("d-m-Y",strtotime($request->input('final')."- 1 day"));
        $minima = date("d-m-Y",strtotime($fecha_actual));
        $minima2 = date("d-m-Y",strtotime($request->input('inicio')."+ 1 day"));

        $rules=[
            'inicio'=>'required|date|before:'.$maxima2.'|after:'.$minima,
            'final'=>'required|date|before:'.$maxima.'|after:'.$minima2,
        ];

        $mensaje=[
            'inicio.required' => 'La fecha de inicio no puede estar vacía',
            'inicio.date' => 'La fecha de inicio debe de ser una fecha valida',
            'inicio.before' => 'La fecha de inicio debe de ser anterior a '.$maxima2,
            'inicio.after' => 'La fecha de inicio debe de ser posterior a '.$minima,
            'final.required' => 'La fecha de final no puede estar vacía',
            'final.date' => 'La fecha de final debe de ser una fecha valida',
            'final.before' => 'La fecha de final debe de ser anterior a '.$maxima,
            'final.after' => 'La fecha de final debe de ser posterior a '.$minima2,
        ];

        $this->validate($request,$rules,$mensaje);

        $vacaciones = Vacaciones::where("id_empleado",$id)->first();
        $vacaciones->id_empleado = $id;
        $vacaciones->inicio= $request->input('inicio');
        $vacaciones->final = $request->input('final');
        $creado = $vacaciones->save();

        return redirect()->route('vacaciones.index')
                ->with('mensaje', 'El empleado se le modificaron las vacaciones exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacaciones  $vacaciones
     * @return \Illuminate\Http\Response
     */
    public function reintegrar($id)
    {
        $oldvacaciones = Vacaciones::where("id_empleado",$id)->first();

        $vacaciones = new VacacionesPasadas();
        $vacaciones->id_empleado = $oldvacaciones->id;
        $vacaciones->inicio= $oldvacaciones->inicio;
        $vacaciones->final = $oldvacaciones->final;
        $creado = $vacaciones->save();
        

        Vacaciones::destroy($oldvacaciones->id);

        return redirect()->route('vacaciones.index')
                ->with('mensaje', 'El empleado fue reintegrado exitosamente');
    }
}
