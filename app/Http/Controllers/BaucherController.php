<?php

namespace App\Http\Controllers;

use App\Models\Baucher;
use App\Models\Planilla;
use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\PlanillaDetalle;
use App\Http\Requests\StoreBaucherRequest;
use App\Http\Requests\UpdateBaucherRequest;

class BaucherController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBaucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $planilla = PlanillaDetalle::where('id_planilla',$id)->get();
        
        $cargos = Cargo::all();
        $p = Planilla::FindOrFail($id);

        $empleado = Empleado::all();

        $baucher = Baucher::where('id_planilla',$id)->get();

        if(count($baucher)<=0){
            
            foreach ($planilla as $detalles) {
                $h_e = $detalles->hora_extra_lunes+$detalles->hora_extra_martes+$detalles->hora_extra_miercoles+$detalles->hora_extra_jueves+$detalles->hora_extra_viernes+$detalles->hora_extra;
                $h_o = $detalles->hora_ordinaria_lunes+$detalles->hora_ordinaria_martes+$detalles->hora_ordinaria_miercoles+$detalles->hora_ordinaria_jueves+$detalles->hora_ordinaria_viernes+$detalles->hora_ordinaria_sabado;

                $baucher = new Baucher();

                $baucher->id_planilla = $id;
                $baucher->id_empleado = $detalles->id_empleado;
                $baucher->precio_hora = $detalles->precio_hora;
                $baucher->hora_ordinaria = $h_o;
                $baucher->hora_extra = $h_e;
                $baucher->deducciones = (($h_o + $h_e)*$detalles->precio_hora)*0.025;

                $creado = $baucher->save();
            }
            return view('planilla/mostrar')->with('planilla', $planilla)
            ->with('p', $p)->with('cargos', $cargos)->with('empleados', $empleado)
            ->with('confirmacion', 'los baucher fueron generados exitosamente');;

        }else{
            return view('planilla/mostrar')->with('planilla', $planilla)
            ->with('p', $p)->with('cargos', $cargos)->with('empleados', $empleado)
            ->with('alerta', 'los baucher fueron generados anteriormente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Baucher  $baucher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $baucher = Baucher::where('id_planilla',$id)
        ->where('id_empleado',auth()->user()->empleados->id)->first();

        return view('baucher/mostrar')->with('baucher',$baucher);
    }
}
