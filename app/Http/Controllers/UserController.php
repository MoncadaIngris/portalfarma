<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Funcion;
use App\Models\Empleado;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmergencyCallReceived;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('usuarios_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $rules=[
            'empleado' => ['required', 'string', 'exists:empleados,id','unique:users,id_empleado'],
            'funcion' => ['required', 'exists:funcions,descripcion'],
        ];

        $mensaje=[

        ];

        $this->validate($request,$rules,$mensaje);

        $empleado = Empleado::findOrFail($request->input('empleado'));

        $password = Str::random(8);

        $usernew = User::create([
            'name' =>  $empleado->nombres." ".$empleado->apellidos,
            'email' => $empleado->correo_electronico,
            'id_empleado' => $request->input('empleado'),
            'password' => Hash::make($password),
        ]);

        $usernew->assignRole($request->input('funcion'));

        $call=[
            'nombres' => $empleado->nombres." ".$empleado->apellidos,
            'email' => $empleado->correo_electronico,
            'telefono' => $empleado->telefono_personal,
            'identidad' => $empleado->DNI,
            'contraseña' => $password,
        ];

        Mail::to($empleado->correo_electronico)->send(new EmergencyCallReceived($call));

        return redirect()->route('home');
    }

    public function showRegistrationForm()
    {
        $empleados=Empleado::select('empleados.*')
        ->leftjoin('users','users.id_empleado','empleados.id')
        ->where('empleados.estado',0)
        ->whereNull('users.id')
        ->get();
        $funcion=Funcion::all();
        return view('auth.register', compact('empleados','funcion'));
    }
    public function primercambio(){
        return view('contrasenia/primercambioclave');
    }

    public function primercambiar(Request $request){
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $usuario = User::findOrFail(auth()->user()->id);

        $usuario->password = bcrypt($request->input('password'));
        $usuario->estado = 1;

        $creado = $usuario->save();

        if ($creado) {
            return redirect()->route('welcome')->with('mensaje', 'La clave fue cambiada exitosamente');
        }
    }
}
