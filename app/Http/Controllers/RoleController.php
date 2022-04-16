<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('roles_editar'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('roles_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));

        $permissions = Permission::all();
        // dd($permissions);
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('roles_nuevo'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));
        $rules=[
            'name' => 'required|max:100|unique:roles,name',
        ];
        $mensaje=[
            'name.required' => 'El nombre no puede estar vacío',
            'name.max' => 'El nombre es muy extenso',
            'name.unique' => 'El nombre ya esta siendo utilizado',
        ];
        $this->validate($request,$rules,$mensaje);
        $role = Role::create($request->only('name'));

        // $role->permissions()->sync($request->input('permissions', []));
        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
       //abort_if(Gate::denies('role_show'), back()->with('denegar','No tiene acceso a esta seccion'));

        $role->load('permissions');
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies('roles_editar'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));
        $permissions = Permission::all();
        $role->load('permissions');
        // dd($role);
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        abort_if(Gate::denies('roles_editar'),redirect()->route('welcome')->with('denegar','No tiene acceso a esta sección'));
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //abort_if(Gate::denies('role_destroy'), back()->with('denegar','No tiene acceso a esta seccion'));

        $role->delete();

        return redirect()->route('roles.index');
    }
}
