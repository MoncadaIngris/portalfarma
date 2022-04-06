<?php

namespace App\Http\Controllers;

use App\Models\Parte;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Permiso;
use App\Models\Modelo;

class PermisoController extends Controller
{

    //public function create()

    public function create()
    {
        $modulo = Modelo::all();
        $funcion = Parte::all();
        return view('permisos/create')->with('permiso')
        ->with('modulo',$modulo)
        ->with('funcion',$funcion);
    }




    public function store(Request $request, $perm=-1)
    {

        $rules=[
            'nombres' => 'required|max:100|unique:permissions,titulo',
            'descripcion'=> 'required|max:200|unique:permissions,name',
            'funcion'=> 'required|exists:partes,id',
            'modelo'=> 'required|exists:modelos,id',
        ];
        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'descripcion.required' => 'El descripción no puede estar vacío',
            'descripcion.unique' => 'La combinación de modelo y función ya ha sido utilizada',
            'funcion.required' => 'La función no puede estar vacío',
            'funcion.exists' => 'La función no existe',
            'modelo.required' => 'El modelo no puede estar vacío',
            'modelo.maexistsx' => 'El modelo no existe',
        ];
        $this->validate($request,$rules,$mensaje);

        $permisos = new Permission();

        $permisos->titulo = $request->input('nombres');
        $permisos->name = $request->input('descripcion');
        $permisos->id_partes = $request->input('funcion');

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
        $permisos = Permission::all();
        return view('permisos/index')->with('permisos', $permisos);
    }

    public function edit($id)
    {
        $permisos = Permiso::findOrFail($id);
        $modulo = Modelo::all();
        $funcion = Parte::all();
        return view("permisos.update")->with("permisos", $permisos)->with('modulo',$modulo)
        ->with('funcion',$funcion);
    }

    public function update(Request $request,  $id)
    {
        $rules=[
            'nombres' => 'required|max:100|unique:permissions,titulo,'.$id,
            'descripcion'=> 'required|max:200|unique:permissions,name,'.$id,
            'funcion'=> 'required|exists:partes,id',
            'modelo'=> 'required|exists:modelos,id',
        ];
        $mensaje=[
            'nombres.required' => 'El nombre no puede estar vacío',
            'nombres.max' => 'El nombre es muy extenso',
            'descripcion.required' => 'El descripción no puede estar vacío',
            'descripcion.unique' => 'La combinación de modelo y función ya ha sido utilizada',
            'funcion.required' => 'La función no puede estar vacío',
            'funcion.exists' => 'La función no existe',
            'modelo.required' => 'El modelo no puede estar vacío',
            'modelo.maexistsx' => 'El modelo no existe',
        ];
        $this->validate($request,$rules,$mensaje);

        $permiso = Permission::findOrFail($id);
        $permiso->titulo = $request->input('nombres');
        $permiso->name = $request->input('descripcion');
        $permiso->id_partes = $request->input('funcion');

        $creado = $permiso->save();

        if ($creado) {
            return redirect()->route('permisos.index')
                ->with('mensaje', 'El permiso fue editado exitosamente');
        }
    }


}

