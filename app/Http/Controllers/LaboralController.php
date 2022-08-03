<?php

namespace App\Http\Controllers;

use App\Models\Laboral;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LaboralController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('laborales_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $laborales= Laboral::orderby("fecha", "desc")->get();

        return view('laboral/index')->with('laborales', $laborales);
    }

    public function carga()
    {
        //abort_if(Gate::denies('laborales_index'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));
        $fecha_actual = date("Y-m-d");
        $fecha_moderna = date("d-m-Y");
        $actual= Laboral::where('fecha',$fecha_actual)->get();

        if(count($actual) >0){
            $laborales= Laboral::where('fecha',$fecha_actual)->get();
            return view('laboral/index')
            ->with('laborales', $laborales)
            ->with('alerta', "Los datos de los empleados del ".$fecha_moderna." fueron cargados anteriormente");
        }else{
            $empleados = Empleado::where('estado',0)->where('id','>',1)
            ->where("id_empleado",null)
            ->select("id","nombres", "apellidos", "DNI")
            ->leftjoin("vacaciones","vacaciones.id_empleado","=","empleados.id")
            ->get();

            foreach ($empleados as $emp) {
                $laboral = new Laboral();

                $laboral->id_empleado = $emp->id;
                $laboral->fecha = $fecha_actual;

                $creado = $laboral->save();
            }
            if ($creado) {
                $laborales= Laboral::where('fecha',$fecha_actual)->get();
                return view('laboral/index')
                ->with('laborales', $laborales)
                ->with('confirmacion', "Los datos de los empleados del ".$fecha_moderna." fueron cargados exitosamente");
            }
        }
    }
}
