<?php

namespace App\Http\Controllers;

use App\Models\SalarioHora;
use App\Models\Jornada;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSalarioHoraRequest;
use App\Http\Requests\UpdateSalarioHoraRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class SalarioHoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salario = SalarioHora::select(DB::raw("*,TIMESTAMPDIFF(hour , hora_entrada, hora_salida ) AS diferencia"))
        ->join("jornadas","salario_horas.id_jornada","=","jornadas.id")->get();
        return view("salario/index")->with("salario",$salario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jornada = jornada::select(DB::raw("*,TIMESTAMPDIFF(hour , hora_entrada, hora_salida ) AS diferencia"))->get();
        return view("salario/create")->with("jornada",$jornada);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalarioHoraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'jornada' => 'required|unique:salario_horas,id_jornada',
            'semanal' => 'required|numeric|min:0|max:999999.99',
        ];

        $mensaje=[
            'jornada.required' => 'La jornada no puede estar vacío',
            'jornada.unique' => 'La jornada ya esta en uso',
            'semanal.required' => 'El salario no puede estar vacio',
            'semanal.numeric' => 'El salario debe de ser numerico',
            'semanal.min' => 'El salario no puede ser negativo',
            'semanal.max' => 'El salario no puede ser tan alto',
        ];

        $this->validate($request,$rules,$mensaje);

        $salario = new SalarioHora();

        $salario->id_jornada = $request->input('jornada');
        $salario->salario_hora= $request->input('hora');
        $salario->salario_dia = $request->input('diario');

        $creado = $salario->save();

        if ($creado) {
            return redirect()->route('salariohora.index')
                ->with('mensaje', 'El salario fue creada exitosamente');
        } else {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalarioHora  $salarioHora
     * @return \Illuminate\Http\Response
     */
    public function show(SalarioHora $salarioHora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalarioHora  $salarioHora
     * @return \Illuminate\Http\Response
     */
    public function edit(SalarioHora $salarioHora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalarioHoraRequest  $request
     * @param  \App\Models\SalarioHora  $salarioHora
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalarioHoraRequest $request, SalarioHora $salarioHora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalarioHora  $salarioHora
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalarioHora $salarioHora)
    {
        //
    }
}
