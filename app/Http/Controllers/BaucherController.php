<?php

namespace App\Http\Controllers;

use App\Models\Baucher;
use App\Models\Planilla;
use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\PlanillaDetalle;
use App\Http\Requests\StoreBaucherRequest;
use App\Http\Requests\UpdateBaucherRequest;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BaucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $baucher = Baucher::where('id_empleado',auth()->user()->empleados->id)->get();
        return view('baucher/index')->with('baucher', $baucher);
    }

    public function general()
    {
        $baucher = Baucher::all();
        return view('baucher/indexgeneral')->with('baucher', $baucher);
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

        $empleado = Empleado::where('estado',0)->where("id_empleado",null)
        ->select("empleados.id","nombres", "apellidos", "DNI","telefono_personal","cargo","vacaciones.inicio")
        ->leftjoin("vacaciones","vacaciones.id_empleado","=","empleados.id")
        ->get();

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

    public function mostrar($id)
    {
        $baucher = Baucher::where('id',$id)->first();

        return view('baucher/mostrargeneral')->with('baucher',$baucher);
    }

    public function createPDF(Request $request){
        $id = $request->input('planilla');

        $baucher = Baucher::where('id_planilla',$id)
        ->where('id_empleado',auth()->user()->empleados->id)->first();

        $data = [
            'title' => 'Baucher  del  '.Carbon::parse($baucher->planillas->fecha_inicio)->locale("es")->isoFormat("DD MMMM YYYY").' al '.Carbon::parse($baucher->planillas->fecha_final)->locale("es")->isoFormat("DD MMMM YYYY"),
            'baucher' =>$baucher,
        ];

        $pdf = PDF::loadView('baucher/pdf', $data)->setPaper('a4','landscape');
        return $pdf->download('Baucher_'.$baucher->planillas->fecha_inicio.'_al_'.$baucher->planillas->fecha_final.'.pdf');
    }

    public function createPDFgeneral(Request $request){
        $id = $request->input('id');

        $baucher = Baucher::where('id',$id)->first();

        $data = [
            'title' => 'Baucher  del  '.Carbon::parse($baucher->planillas->fecha_inicio)->locale("es")->isoFormat("DD MMMM YYYY").' al '.Carbon::parse($baucher->planillas->fecha_final)->locale("es")->isoFormat("DD MMMM YYYY"),
            'baucher' =>$baucher,
        ];

        $pdf = PDF::loadView('baucher/pdf', $data)->setPaper('a4','landscape');
        return $pdf->download('Baucher_'.$baucher->planillas->fecha_inicio.'_al_'.$baucher->planillas->fecha_final.'.pdf');
    }
}
