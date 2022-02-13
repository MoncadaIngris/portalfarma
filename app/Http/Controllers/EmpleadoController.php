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
        $fecha_actual = date("d-m-Y");
        $maxima = date('d-m-Y',strtotime($fecha_actual."- 18 year"));
        $minima = date('d-m-Y',strtotime($fecha_actual."- 65 year"));

        $rules=[
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'email' => 'required|max:100|email|unique:empleados,correo_electronico',
            'personal'=> 'required|unique:empleados,telefono_personal|numeric|regex:([9,8,3,2]{1}[0-9]{7})',
            'emergencia'=> 'required|unique:empleados,telefono_alternativo|numeric|regex:([9,8,3,2]{1}[0-9]{7})',
            'birthday'=>'required|date|before:'.$maxima.'|after:'.$minima,
            'dni'=> 'required|unique:empleados,DNI|numeric|regex:([0-1]{1}[0-8]{1}[0-9]{11})',
            'foto' => 'required|mimes:jpeg,bmp,png',
            'direccion'=>'required|max:200',
        ];

        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'apellidos.required' => 'El apellido no puede estar vacío',
            'apellidos.max' => 'El apellido es muy extenso',
            'email.required' => 'El correo electrónico no puede estar vacío',
            'email.max' => 'El correo electrónico es muy extenso',
            'email.email' => 'En el campo correo electrónico debe de ingresar un correo valido',
            'email.unique' => 'El correo electrónico ingresado ya esta en uso',
            'personal.required' => 'El teléfono personal no puede estar vacío',
            'personal.regex' => 'El teléfono personal debe contener 8 dígitos e iniciar con 2,3,8 o 9',
            'personal.numeric' => 'En teléfono personal no debe de incluir letras ni signos',
            'personal.unique' => 'El teléfono personal ingresado ya esta en uso',
            'emergencia.required' => 'El teléfono emergencia no puede estar vacío',
            'emergencia.regex' => 'El teléfono emergencia debe contener 8 dígitos e iniciar con 2,3,8 o 9',
            'emergencia.numeric' => 'En teléfono emergencia no debe de incluir letras ni signos',
            'emergencia.unique' => 'El teléfono emergencia ya esta en uso',
            'birthday.required' => 'La fecha de nacimiento no puede estar vacía',
            'birthday.date' => 'La fecha de nacimiento debe de ser una fecha valida',
            'birthday.before' => 'La fecha de nacimiento debe de ser anterior a '.$maxima,
            'birthday.after' => 'La fecha de nacimiento debe de ser posterior a '.$minima,
            'dni.required' => 'La identidad no puede estar vacía',
            'dni.regex' => 'El formato de la identidad no es valida',
            'dni.numeric' => 'La identidad debe de ser números',
            'dni.unique' => 'La identidad ya esta en uso',
            'foto.required' => 'La de fotografía no puede estar vacía',
            'foto.mimes' => 'Debe de subir una fotografía',
            'direccion.required' => 'La dirección no puede ser vacía',
            'direccion.max' => 'La dirección es muy extenso',
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
    public function show($id)
    {
        $empleado= Empleado::findOrFail($id);
        return view('empleados.show')->with('empleado', $empleado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view("empleados.update")->with("empleado", $empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpleadoRequest  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpleadoRequest $request, $id)
    {
        $this->validate($request, [
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            "correo_electronico" => "required|unique:empleados,correo_electronico," . $id,
            "telefono_personal" => "required|unique:empleados,telefono_personal," . $id,
            "telefono_alternativo" => "required|unique:empleados,telefono_alternativo," . $id,
            'fecha_de_nacimiento'=>'required|date',
            "DNI" => "required|unique:empleados,DNI," . $id,
            'foto' => '',
            'direccion'=>'required|max:200',
        ], [
            'nombres.required' => 'El campo de nombres no puede ser vació',
            'nombres.max' => 'El campo nombres es muy extenso',
            'apellidos.required' => 'El campo de apellidos no puede ser vació',
            'apellidos.max' => 'El campo apellidos es muy extenso',
            'correo_electronico.required' => 'El campo de correo electrónico no puede ser vació',
            'correo_electronico.max' => 'El campo correo electrónico es muy extenso',
            'correo_electronico.email' => 'En el campo correo electrónico debe de ingresar un correo valido',
            'correo_electronico.unique' => 'El correo electrónico ya esta en uso',
            'telefono_personal.required' => 'El campo de teléfono personal no puede ser vació',
            'telefono_personal.max' => 'El campo teléfono personal debe contener 8 caracteres',
            'telefono_personal.min' => 'El campo teléfono personal debe contener 8 caracteres',
            'telefono_personal.numeric' => 'En el campo teléfono personal debe de ser números',
            'telefono_personal.unique' => 'El teléfono personal ya esta en uso',
            'telefono_alternativo.required' => 'El campo de teléfono emergencia no puede ser vació',
            'telefono_alternativo.max' => 'El campo teléfono emergencia debe contener 8 caracteres',
            'telefono_alternativo.min' => 'El campo teléfono emergencia debe contener 8 caracteres',
            'telefono_alternativo.numeric' => 'En el campo teléfono emergencia debe de ser números',
            'telefono_alternativo.unique' => 'El teléfono emergencia ya esta en uso',
            'fecha_de_nacimiento.required' => 'El campo de fecha de nacimiento no puede ser vació',
            'fecha_de_nacimiento.date' => 'El campo fecha de nacimiento debe de ser una fecha',
            'DNI.required' => 'El campo de DNI no puede ser vació',
            'DNI.max' => 'El campo DNI debe contener 13 caracteres',
            'DNI.min' => 'El campo DNI debe contener 13 caracteres',
            'DNI.numeric' => 'En el campo DNI debe de ser números',
            'DNI.unique' => 'El DNI ya esta en uso',
            'direccion.required' => 'El campo de dirección no puede ser vació',
            'direccion.max' => 'El campo dirección es muy extenso',
        ]);

        $empleado= Empleado::findOrFail($id);
        $empleado->nombres= $request->input("nombres");
        $empleado->apellidos= $request->input('apellidos');
        $empleado->correo_electronico = $request->input('correo_electronico');
        $empleado->telefono_personal= $request->input('telefono_personal');
        $empleado->telefono_alternativo = $request->input('telefono_alternativo');
        $empleado->fecha_de_nacimiento= $request->input('fecha_de_nacimiento');
        $empleado->direccion = $request->input('direccion');
        $empleado->DNI= $request->input('DNI');

        $creado = $empleado->save();

        if ($creado) {
            return redirect()->route('empleados.index')
                ->with('mensaje', 'El empleado fue editado exitosamente');
        } else {

        }
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

    public function desactivados()
    {
        $empleados = Empleado::where('estado',1)->get();

        return view('empleados/desactivados')->with('empleados', $empleados);
    }

    public function activar(UpdateEmpleadoRequest $request, $id)
    {

        $empleado= Empleado::findOrFail($id);
        $empleado->estado= 0;

        $creado = $empleado->save();

        return redirect()->route('empleados.desactivado')
            ->with('mensaje', 'El empleado fue activado exitosamente');
    }

}
