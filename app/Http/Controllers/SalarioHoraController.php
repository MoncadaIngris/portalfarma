<?php

namespace App\Http\Controllers;

use App\Models\SalarioHora;
use App\Models\Jornada;
use App\Models\Cargo;
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
        $salario = SalarioHora::all();
        return view("salario/index")->with("salario",$salario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargo = Cargo::all();
        $jornada = jornada::select(DB::raw("*,TIMESTAMPDIFF(hour , hora_entrada, hora_salida ) AS diferencia"))->get();
        return view("salario/create")->with("jornada",$jornada)->with('cargo', $cargo);
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
            'jornada' => 'required|unique:cargos,descripcion',
            'semanal' => 'required|numeric|min:0|max:999999.99',
        ];

        $mensaje=[
            'jornada.required' => 'El cargo no puede estar vacío',
            'jornada.unique' => 'El cargo ya esta en uso',
            'semanal.required' => 'El salario no puede estar vacio',
            'semanal.numeric' => 'El salario debe de ser numerico',
            'semanal.min' => 'El salario no puede ser negativo',
            'semanal.max' => 'El salario no puede ser tan alto',
        ];

        $this->validate($request,$rules,$mensaje);

        $cargo = new Cargo();
        $cargo->descripcion = $request->input('jornada');
        $creado = $cargo->save();

        $salario = new SalarioHora();

        $salario->id_cargo = $cargo->id;
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
