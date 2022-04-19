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
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function index()
    {
       // $users = User::get();

       // return view('usuarios/index')->with('users', $users);

       
       $users =User::select('users.*',DB::raw("empleados.apellidos as apellidos"),
         DB::raw("empleados.telefono_personal as telefono"),
         DB::raw("empleados.DNI as identidad"))
       ->join("empleados","empleados.id","=","users.id_empleado")
      
       ->get();
    
       return view('usuarios/index')->with('users', $users);

    }



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

    public function nueva_contrasenia(){
        return view('perfil.nueva_contrasenia');
    }

    public function nueva_contrasenia_cambiar(Request $request){
        try {
            $valid = validator($request->only('current_password', 'password', 'confirm_password'), [
                'current_password' => 'required|string|min:8',
                'password' => 'required|string|min:6|different:current_password',
                'confirm_password' => 'required_with:password|same:password|string|min:8',
            ], [
                'confirm_password.required_with' => 'Confirm password is required.'
            ]);

            if ($valid->fails()) {
                return redirect()->route('perfil.nueva_contrasenia')->with('error', 'La nueva contraseña y la confirmación no coinciden');
            }

            if (Hash::check($request->get('current_password'), auth()->user()->password)) {
                $usuario = User::findOrFail(auth()->user()->id);

                $usuario->password = bcrypt($request->input('password'));
                $usuario->estado = 1;
                if ($usuario->save()) {
                    return redirect()->route('perfil')->with('mensaje', 'Tu contraseña fue actualizada exitosamente.');
                }
            } else {
                return redirect()->route('perfil.nueva_contrasenia')->with('error', 'La contraseña actual que ingresó es incorrecta.');
            }
        } catch (Exception $e) {
            return redirect()->route('perfil.nueva_contrasenia')->with('error', 'Por favor intente nuevamente.');
        }
    }


    public function perfil(){
        return view('perfil.perfil');
    }

    public function editar(){
        return view('perfil.editar');
    }

    public function update(Request $request){
        //{{auth()->user()->empleados->id}}
        $id = auth()->user()->empleados->id;
        $this->validate($request, [
            "correo_electronico" => "required|max:100|email|unique:empleados,correo_electronico," . $id,
            "telefono_personal" => "required|numeric|regex:([9,8,3,2]{1}[0-9]{7})|unique:empleados,telefono_personal," . $id,
            "telefono_alternativo" => "required|numeric|regex:([9,8,3,2]{1}[0-9]{7})|unique:empleados,telefono_alternativo," . $id,
            'foto' => 'sometimes|mimes:jpeg,bmp,png',
            'direccion'=>'required|max:200',
        ], [
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

        $empleado->correo_electronico = $request->input('correo_electronico');
        $empleado->telefono_personal= $request->input('telefono_personal');
        $empleado->telefono_alternativo = $request->input('telefono_alternativo');
        $empleado->direccion = $request->input('direccion');

        $creado = $empleado->save();

        if ($creado) {
            $usuario= User::findOrFail(auth()->user()->id);

            $usuario->email = $request->input('correo_electronico');

            $creado2 = $usuario->save();

            if($creado2){
                return redirect()->route('perfil')
                ->with('mensaje', 'Los datos fueron editados exitosamente');
            }

        }
    }
}
