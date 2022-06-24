<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use App\Models\Laboral;
use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\PlanillaDetalle;
use App\Models\SalarioHora;
use App\Http\Requests\StorePlanillaRequest;
use App\Http\Requests\UpdatePlanillaRequest;
use Illuminate\Support\Facades\DB;
use PDF;
use Excel;
use Illuminate\Http\Request;
use App\Exports\PlanillaExport;

class PlanillaController extends Controller
{
    public function createPDF(Request $request){
        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $id = $request->input('planilla');
        $emp = $request->input('employee');
        $car = $request->input('cargo');

        $pla = Planilla::FindOrFail($id);

        if ($emp != "" && $car != "" ) {

            $detail = PlanillaDetalle::join('empleados','planilla_detalles.id_empleado','=','empleados.id')
            ->join('cargos','empleados.cargo','=','cargos.id')
            ->where('id_planilla',$id)
            ->where('cargos.id',$car)
            ->where('id_empleado',$emp)
            ->get();
            $carg = Cargo::where('id',$car)->first();
            $emple = Empleado::where('id',$emp)->first();

            $data = [
                'title' => 'Planilla de '.$carg->descripcion.' con el empleado '.$emple->nombres.' '.$emple->apellidos.' del '.$inicio.' al '.$final,
                'planilla' =>$detail,
                'p' =>$pla,
            ];
               
            $pdf = PDF::loadView('planilla/pdf', $data)->setPaper('a3','landscape');
            return $pdf->download('Planilla_del_'.$inicio.'_al_'.$final.'.pdf');


        }else{
            if ($emp != "") {
                $detail = PlanillaDetalle::where('id_planilla',$id)
                ->where('id_empleado',$emp)
                ->get();
                $emple = Empleado::where('id',$emp)->first();
               

                $data = [
                    'title' => 'Planilla de '.$emple->nombres.' '.$emple->apellidos.' del '.$inicio.' al '.$final,
                    'planilla' =>$detail,
                    'p' =>$pla,
                ];
                   
                $pdf = PDF::loadView('planilla/pdf', $data)->setPaper('a3','landscape');
                return $pdf->download('Planilla_del_'.$inicio.'_al_'.$final.'.pdf');


            } else {
                if ($car != "") {
                    $detail = PlanillaDetalle::join('empleados','planilla_detalles.id_empleado','=','empleados.id')
                    ->join('cargos','empleados.cargo','=','cargos.id')
                    ->where('id_planilla',$id)
                    ->where('cargos.id',$car)
                    ->get();
                    $carg = Cargo::where('id',$car)->first();
                    

                    $data = [
                        'title' => 'Planilla de '.$carg->descripcion.' del '.$inicio.' al '.$final,
                        'planilla' =>$detail,
                        'p' =>$pla,
                    ];
                       
                    $pdf = PDF::loadView('planilla/pdf', $data)->setPaper('a3','landscape');
                    return $pdf->download('Planilla_del_'.$inicio.'_al_'.$final.'.pdf');



                }else{
                    $detail = PlanillaDetalle::where('id_planilla',$id)->get();
                    
                    
                    $data = [
                        'title' => 'Planilla del '.$inicio.' al '.$final,
                        'planilla' =>$detail,
                        'p' =>$pla,
                    ];
                       
                    $pdf = PDF::loadView('planilla/pdf', $data)->setPaper('a3','landscape');
                    return $pdf->download('Planilla_del_'.$inicio.'_al_'.$final.'.pdf');



                }
            }
        }
    }

    public function exportxlsx(Request $request){
        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $id = $request->input('planilla');
        $emp = $request->input('employee');
        $car = $request->input('cargo');

        $pla = Planilla::FindOrFail($id);

        if ($emp != "" && $car != "" ) {

            $detail = PlanillaDetalle::join('empleados','planilla_detalles.id_empleado','=','empleados.id')
            ->join('cargos','empleados.cargo','=','cargos.id')
            ->where('id_planilla',$id)
            ->where('cargos.id',$car)
            ->where('id_empleado',$emp)
            ->get();
            $carg = Cargo::where('id',$car)->first();
            $emple = Empleado::where('id',$emp)->first();

            return Excel::download(new PlanillaExport($detail, $pla), 'Planilla_del_empleado_'.$emple->nombres.'_'.$emple->apellidos.'_con_cargo_'.$carg->descripcion.'_con_fecha_'.$inicio.'_al_'.$final.'.xlsx');
        }else{
            if ($emp != "") {
                $detail = PlanillaDetalle::where('id_planilla',$id)
                ->where('id_empleado',$emp)
                ->get();
                $emple = Empleado::where('id',$emp)->first();
                return Excel::download(new PlanillaExport($detail, $pla), 'Planilla_del_empleado_'.$emple->nombres.'_'.$emple->apellidos.'_con_fecha_'.$inicio.'_al_'.$final.'.xlsx');
            } else {
                if ($car != "") {
                    $detail = PlanillaDetalle::join('empleados','planilla_detalles.id_empleado','=','empleados.id')
                    ->join('cargos','empleados.cargo','=','cargos.id')
                    ->where('id_planilla',$id)
                    ->where('cargos.id',$car)
                    ->get();
                    $carg = Cargo::where('id',$car)->first();
                    return Excel::download(new PlanillaExport($detail, $pla), 'Planilla_con_cargo_'.$carg->descripcion.'_con_fecha_'.$inicio.'_al_'.$final.'.xlsx');
                }else{
                    $detail = PlanillaDetalle::where('id_planilla',$id)->get();
                    return Excel::download(new PlanillaExport($detail, $pla), 'Planilla_del_'.$inicio.'_al_'.$final.'.xlsx');
                }
            }
        }
    }

    public function exportcsv(Request $request){
        $inicio = $request->input('start_date');
        $final = $request->input('end_date');
        $id = $request->input('planilla');
        $emp = $request->input('employee');
        $car = $request->input('cargo');

        $pla = Planilla::FindOrFail($id);

        if ($emp != "" && $car != "" ) {

            $detail = PlanillaDetalle::join('empleados','planilla_detalles.id_empleado','=','empleados.id')
            ->join('cargos','empleados.cargo','=','cargos.id')
            ->where('id_planilla',$id)
            ->where('cargos.id',$car)
            ->where('id_empleado',$emp)
            ->get();
            $carg = Cargo::where('id',$car)->first();
            $emple = Empleado::where('id',$emp)->first();

            return Excel::download(new PlanillaExport($detail, $pla), 'Planilla_del_empleado_'.$emple->nombres.'_'.$emple->apellidos.'_con_cargo_'.$carg->descripcion.'_con_fecha_'.$inicio.'_al_'.$final.'.csv');
        }else{
            if ($emp != "") {
                $detail = PlanillaDetalle::where('id_planilla',$id)
                ->where('id_empleado',$emp)
                ->get();
                $emple = Empleado::where('id',$emp)->first();
                return Excel::download(new PlanillaExport($detail, $pla), 'Planilla_del_empleado_'.$emple->nombres.'_'.$emple->apellidos.'_con_fecha_'.$inicio.'_al_'.$final.'.csv');
            } else {
                if ($car != "") {
                    $detail = PlanillaDetalle::join('empleados','planilla_detalles.id_empleado','=','empleados.id')
                    ->join('cargos','empleados.cargo','=','cargos.id')
                    ->where('id_planilla',$id)
                    ->where('cargos.id',$car)
                    ->get();
                    $carg = Cargo::where('id',$car)->first();
                    return Excel::download(new PlanillaExport($detail, $pla), 'Planilla_con_cargo_'.$carg->descripcion.'_con_fecha_'.$inicio.'_al_'.$final.'.csv');
                }else{
                    $detail = PlanillaDetalle::where('id_planilla',$id)->get();
                    return Excel::download(new PlanillaExport($detail, $pla), 'Planilla_del_'.$inicio.'_al_'.$final.'.csv');
                }
            }
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planilla = Planilla::all();
        return view('planilla/index')->with('planilla', $planilla);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlanillaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //fechas de la planilla
        $firstday = date('Y-m-d', strtotime('monday last week'));
        $lastday = date('Y-m-d', strtotime('saturday last week'));

        $emp = Empleado::all();
        $cargo = SalarioHora::all();

        $p = Planilla::where('fecha_inicio', $firstday)->where('fecha_final', $lastday)->get();

        if (count($cargo) == 5) {
           
            if (count($p) < 1) {
                $planilla = new Planilla();

                $planilla->fecha_inicio = $firstday;
                $planilla->fecha_final = $lastday;
    
                $creado = $planilla->save();
    
                foreach ($emp as $j) {
    
                    $detalles = new PlanillaDetalle();
        
                    $detalles->id_planilla = $planilla->id;
                    $detalles->id_empleado = $j->id;
                    $detalles->precio_hora = $j->cargos->salario->salario_hora;
                    for ($i=0; $i < 6; $i++) { 
                        $nuevafecha = strtotime ( '+'.$i.' day' , strtotime ( $firstday ) ) ;
                        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
        
                        $laboral = Laboral::where('id_empleado',$j->id)->where('fecha',$nuevafecha)->first();
                        $h_o = 0;
                        $h_e = 0;
                        if (is_null($laboral)) {
                        }else{
                            $inicio = date_create('2000-01-01'.$laboral->entrada->hora);
                            $final = date_create('2000-01-01'.$laboral->salida->hora);
                            if ($laboral->entrada->hora > $laboral->salida->hora) {
                                $final = date_create('2000-01-02'.$laboral->salida->hora);
                            }
                            $diferencia = date_diff($inicio, $final);
                            $horas = $diferencia->format("%h");
        
                            if ($horas > 8){
                                $h_o = 8;
                                $h_e = $horas - 8;
                            }else{
                                $h_o = $horas;
                                $h_e = 0;
                            }
        
                            switch ($i) {
                                case 0:
                                    $detalles->hora_ordinaria_lunes = $h_o;
                                    $detalles->hora_extra_lunes = $h_e;
                                break;
                                case 1:
                                    $detalles->hora_ordinaria_martes = $h_o;
                                    $detalles->hora_extra_martes = $h_e;
                                break;
                                case 2:
                                    $detalles->hora_ordinaria_miercoles = $h_o;
                                    $detalles->hora_extra_miercoles = $h_e;
                                break;
                                case 3:
                                    $detalles->hora_ordinaria_jueves = $h_o;
                                    $detalles->hora_extra_jueves = $h_e;
                                break;
                                case 4:
                                    $detalles->hora_ordinaria_viernes = $h_o;
                                    $detalles->hora_extra_viernes = $h_e;
                                break;
                                case 5:
                                    $detalles->hora_ordinaria_sabado = $h_o;
                                    $detalles->hora_extra_sabado = $h_e;
                                break;
                            }
                        }
                    }
                    $detalles->seguro = 1200;
                    $creado = $detalles->save();
                }
    
                $planilla = Planilla::all();
                return view('planilla/index')->with('planilla', $planilla);
            }else{
                $planilla = Planilla::all();
                return view('planilla/index')->with('planilla', $planilla)
                ->with('error', 'La planilla del '.$firstday.' al '.$lastday.' ya fue agregada anteriormente');
            }
    
        }else{
            $planilla = Planilla::all();
            return view('planilla/index')->with('planilla', $planilla)
            ->with('error', 'Agregue primero un salario por hora a cada cargo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $cargos = Cargo::all();
        $p = Planilla::FindOrFail($id);

        $empleado = Empleado::all();

        $emp = trim($request->get('employee'));
        $car = trim($request->get('cargo'));

        if ($emp != "" && $car != "" ) {

            $detail = PlanillaDetalle::join('empleados','planilla_detalles.id_empleado','=','empleados.id')
            ->join('cargos','empleados.cargo','=','cargos.id')
            ->where('id_planilla',$id)
            ->where('cargos.id',$car)
            ->where('id_empleado',$emp)
            ->get();
            $carg = Cargo::where('id',$car)->first();
            $emple = Empleado::where('id',$emp)->first();
            return view('planilla/mostrar')->with('planilla', $detail)
                    ->with('p', $p)->with('cargos', $cargos)
                    ->with('empleados', $empleado)->with('emple', $emple)
                    ->with('carg', $carg);
        }else{
            if ($emp != "") {
                $detail = PlanillaDetalle::where('id_planilla',$id)
                ->where('id_empleado',$emp)
                ->get();
                $emple = Empleado::where('id',$emp)->first();
                return view('planilla/mostrar')->with('planilla', $detail)
                    ->with('p', $p)->with('cargos', $cargos)
                    ->with('empleados', $empleado)->with('emple', $emple);
            } else {
                if ($car != "") {
                    $detail = PlanillaDetalle::join('empleados','planilla_detalles.id_empleado','=','empleados.id')
                    ->join('cargos','empleados.cargo','=','cargos.id')
                    ->where('id_planilla',$id)
                    ->where('cargos.id',$car)
                    ->get();
                    $carg = Cargo::where('id',$car)->first();
                    return view('planilla/mostrar')->with('planilla', $detail)
                    ->with('p', $p)->with('cargos', $cargos)
                    ->with('empleados', $empleado)->with('carg', $carg);
                }else{
                    $detail = PlanillaDetalle::where('id_planilla',$id)->get();
                    return view('planilla/mostrar')->with('planilla', $detail)->with('p', $p)->with('cargos', $cargos)->with('empleados', $empleado);
                }
            }
            
        }
    }

}
