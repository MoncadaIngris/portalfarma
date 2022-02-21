<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $empleados = Empleado::where('estado',0)->select("id","nombres", "apellidos", "DNI","telefono_personal")->get();

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
        $max = date('d-m-Y',strtotime($fecha_actual."- 18 year"));
        $minima = date('d-m-Y',strtotime($fecha_actual."- 65 year"));
        $maxima = date("d-m-Y",strtotime($max."+ 1 days"));

        $rules=[
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'email' => 'required|max:100|email|unique:empleados,correo_electronico',
            'personal'=> 'required|unique:empleados,telefono_personal|numeric|regex:([9,8,3,2]{1}[0-9]{7})',
            'emergencia'=> 'required|unique:empleados,telefono_alternativo|numeric|regex:([9,8,3,2]{1}[0-9]{7})',
            'birthday'=>'required|date|before:'.$maxima.'|after:'.$minima,
            'dni'=> 'required|unique:empleados,DNI|numeric|regex:([0-1]{1}[0-9]{1}[0-2]{1}[0-8]{1}[0-9]{9})',
            'foto' => 'required|mimes:jpeg,bmp,png',
            'direccion'=>'required|max:200',
        ];

        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'apellidos.required' => 'El apellido no puede estar vacío',
            'apellidos.max' => 'El apellido es muy extenso',
            'email.required' => 'El correo electrónico no puede estar vacío',
            'email.regex' => 'El correo electrónico tiene un formato invalido',
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
        $empleado->fecha_de_ingreso= $request->input('ingreso');
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
        $fecha_actual = date("d-m-Y");
        $max = date('d-m-Y',strtotime($fecha_actual."- 18 year"));
        $minima = date('d-m-Y',strtotime($fecha_actual."- 65 year"));
        $maxima = date("d-m-Y",strtotime($max."+ 1 days"));

        $this->validate($request, [
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            "correo_electronico" => "required|max:100|email|unique:empleados,correo_electronico," . $id,
            "telefono_personal" => "required|numeric|regex:([9,8,3,2]{1}[0-9]{7})|unique:empleados,telefono_personal," . $id,
            "telefono_alternativo" => "required|numeric|regex:([9,8,3,2]{1}[0-9]{7})|unique:empleados,telefono_alternativo," . $id,
            'fecha_de_nacimiento'=>'required|date|before:'.$maxima.'|after:'.$minima,
            "DNI" => "required|numeric|regex:([0-1]{1}[0-8]{1}[0-2]{1}[0-8]{1}[0-9]{9})|unique:empleados,DNI," . $id,
            'foto' => 'sometimes|mimes:jpeg,bmp,png',
            'direccion'=>'required|max:200',
        ], [
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'apellidos.required' => 'El apellido no puede estar vacío',
            'apellidos.max' => 'El apellido es muy extenso',
            'correo_electronico.required' => 'El correo electrónico no puede estar vacío',
            'correo_electronico.regex' => 'El correo electrónico tiene un formato invalido',
            'correo_electronico.max' => 'El correo electrónico es muy extenso',
            'correo_electronico.email' => 'En el campo correo electrónico debe de ingresar un correo valido',
            'correo_electronico.unique' => 'El correo electrónico ingresado ya esta en uso',
            'telefono_personal.required' => 'El teléfono personal no puede estar vacío',
            'telefono_personal.regex' => 'El teléfono personal debe contener 8 dígitos e iniciar con 2,3,8 o 9',
            'telefono_personal.numeric' => 'En teléfono personal no debe de incluir letras ni signos',
            'telefono_personal.unique' => 'El teléfono personal ingresado ya esta en uso',
            'telefono_alternativo.required' => 'El teléfono emergencia no puede estar vacío',
            'telefono_alternativo.regex' => 'El teléfono emergencia debe contener 8 dígitos e iniciar con 2,3,8 o 9',
            'telefono_alternativo.numeric' => 'En teléfono emergencia no debe de incluir letras ni signos',
            'telefono_alternativo.unique' => 'El teléfono emergencia ya esta en uso',
            'fecha_de_nacimiento.required' => 'La fecha de nacimiento no puede estar vacía',
            'fecha_de_nacimiento.date' => 'La fecha de nacimiento debe de ser una fecha valida',
            'fecha_de_nacimiento.before' => 'La fecha de nacimiento debe de ser anterior a '.$maxima,
            'fecha_de_nacimiento.after' => 'La fecha de nacimiento debe de ser posterior a '.$minima,
            'DNI.required' => 'La identidad no puede estar vacía',
            'DNI.regex' => 'El formato de la identidad no es valida',
            'DNI.numeric' => 'La identidad debe de ser números',
            'DNI.unique' => 'La identidad ya esta en uso',
            'foto.sometimes' => 'La de fotografía no puede estar vacía',
            'foto.mimes' => 'Debe de subir una fotografía',
            'direccion.required' => 'La dirección no puede ser vacía',
            'direccion.max' => 'La dirección es muy extenso',
        ]);

        $empleado= Empleado::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = 'images/';
            $filename = time().'.'.$file->getClientOriginalName();
            Storage::delete('public/' . $empleado->fotografia);
            $uploadSuccess = $request->file('foto')->move($destinationPath,$filename);
            //formulario
            $empleado->fotografia = 'images/' . $filename;
        }

        $empleado->nombres= $request->input("nombres");
        $empleado->apellidos= $request->input('apellidos');
        $empleado->correo_electronico = $request->input('correo_electronico');
        $empleado->telefono_personal= $request->input('telefono_personal');
        $empleado->telefono_alternativo = $request->input('telefono_alternativo');
        $empleado->fecha_de_nacimiento= $request->input('fecha_de_nacimiento');
        $empleado->fecha_de_ingreso= $request->input('ingreso');
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

    }
    public function desactivar (UpdateEmpleadoRequest $request, $id)
    {
    $empleado= Empleado::findOrFail($id);
    $empleado->estado= 1;

     $creado = $empleado->save();

    return redirect()->route('empleados.index');
    }


    public function desactivados()
    {
        $empleados = Empleado::where('estado',1)->select("id","nombres", "apellidos", "DNI","telefono_personal")->get();

        return view('empleados/desactivados')->with('empleados', $empleados);
    }

    public function activar(UpdateEmpleadoRequest $request, $id)
    {

        $empleado= Empleado::findOrFail($id);
        $empleado->estado= 0;

        $creado = $empleado->save();

        return redirect()->route('empleados.desactivado');
    }




}
