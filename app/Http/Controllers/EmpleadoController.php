<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $empleados = Empleado::where('estado',0)->get();

        return view('empleados/index')->with('empleados', $empleados);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmpleadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'email' => 'required|max:100|email|unique:empleados,correo_electronico',
            'personal'=> 'required|unique:empleados,telefono_personal|numeric|min:10000000|max:99999999',
            'emergencia'=> 'required|unique:empleados,telefono_alternativo|numeric|min:10000000|max:99999999',
            'birthday'=>'required|date',
            'dni'=> 'required|unique:empleados,DNI|numeric|min:1000000000000|max:9999999999999',
            'foto' => 'required',
            'direccion'=>'required|max:200',
        ];

        $mensaje=[
            'nombres.required' => 'El campo de nombres no puede ser vació',
            'nombres.max' => 'El campo nombres es muy extenso',
            'apellidos.required' => 'El campo de apellidos no puede ser vació',
            'apellidos.max' => 'El campo apellidos es muy extenso',
            'email.required' => 'El campo de correo electrónico no puede ser vació',
            'email.max' => 'El campo correo electrónico es muy extenso',
            'email.email' => 'En el campo correo electrónico debe de ingresar un correo valido',
            'email.unique' => 'El correo electrónico ya esta en uso',
            'personal.required' => 'El campo de teléfono personal no puede ser vació',
            'personal.max' => 'El campo teléfono personal debe contener 8 caracteres',
            'personal.min' => 'El campo teléfono personal debe contener 8 caracteres',
            'personal.numeric' => 'En el campo teléfono personal debe de ser números',
            'personal.unique' => 'El teléfono personal ya esta en uso',
            'emergencia.required' => 'El campo de teléfono emergencia no puede ser vació',
            'emergencia.max' => 'El campo teléfono emergencia debe contener 8 caracteres',
            'emergencia.min' => 'El campo teléfono emergencia debe contener 8 caracteres',
            'emergencia.numeric' => 'En el campo teléfono emergencia debe de ser números',
            'emergencia.unique' => 'El teléfono emergencia ya esta en uso',
            'birthday.required' => 'El campo de fecha de nacimiento no puede ser vació',
            'birthday.date' => 'El campo fecha de nacimiento debe de ser una fecha',
            'dni.required' => 'El campo de DNI no puede ser vació',
            'dni.max' => 'El campo DNI debe contener 13 caracteres',
            'dni.min' => 'El campo DNI debe contener 13 caracteres',
            'dni.numeric' => 'En el campo DNI debe de ser números',
            'dni.unique' => 'El DNI ya esta en uso',
            'foto.required' => 'El campo de fotografía no puede ser vació',
            'direccion.required' => 'El campo de dirección no puede ser vació',
            'direccion.max' => 'El campo dirección es muy extenso',
        ];

        $this->validate($request,$rules,$mensaje);

        $empleado = new Empleado();

        $empleado->nombres = $request->input('nombres');
        $empleado->apellidos= $request->input('apellidos');
        $empleado->correo_electronico = $request->input('email');
        $empleado->telefono_personal= $request->input('personal');
        $empleado->telefono_alternativo = $request->input('emergencia');
        $empleado->fecha_de_nacimiento= $request->input('birthday');
        $empleado->direccion = $request->input('direccion');
        $empleado->DNI= $request->input('dni');

        $file = $request->file('foto');
        $destinationPath = 'images/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('foto')->move($destinationPath,$filename);

        $empleado->fotografia = 'images/'.$filename;



        $creado = $empleado->save();

        if ($creado) {
            return redirect()->route('empleados.index')
                ->with('mensaje', 'El empleado fue creada exitosamente');
        } else {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpleadoRequest  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
