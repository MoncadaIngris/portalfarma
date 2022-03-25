<?php

namespace App\Http\Controllers;
use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{

    //public function create()
    
    public function create()
    {
        return view('permisos/create')->with('permiso');
    }




    public function store(Request $request, $perm=-1)
    {

        $rules=[
            'nombres' => 'required|max:100',
            'descripcion'=> 'required|max:200',


        ];
        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'descripcion.required' => 'El descripción no puede estar vacío',
            'descripcion.max' => 'La descripcion es muy extenso',
        ];
        $this->validate($request,$rules,$mensaje);

        $permisos = new Permiso();

        $permisos->nombres = $request->input('nombres');
        $permisos->descripcion = $request->input('descripcion');
        
        $permi = $permisos->save();

        if ($permi) {

            if ($perm != -1){
                return redirect()->route('permisos.create',["permisos"=>$permisos->id])
                ->with('mensaje', 'El permiso fue creado exitosamente');
            }else{
                return redirect()->route('permisos.index')
                ->with('mensaje', 'El permiso fue añadido exitosamente');
            }
        } else {

        }
    }
    public function index()
    {
        $permisos = Permiso::select("id","nombres", "descripcion")->get();

        return view('permisos/index')->with('permisos', $permisos);
    }
   
}

