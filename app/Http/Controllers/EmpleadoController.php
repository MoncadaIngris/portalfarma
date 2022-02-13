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
