@extends('plantilla.madre')
@section('titulo')
    Listado De Usuarios
@stop
@section('contenido')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
    <style>
        #prueba {
            overflow:auto;
        }
      </style>
  
    <button class="btn btn-nuevo" onclick="window.location='{{route('registrar')}}'">
    <i class="fa-solid fa-folder-plus"></i> Agregar Usuario</button>
    
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Nombres</th>
            <th scope="col" class="sorting" style="text-align: center">Apellidos</th>
            <th scope="col" class="sorting" style="text-align: center">Teléfono</th>
            <th scope="col" class="sorting" style="text-align: center">Identidad</th>
            <th scope="col" class="sorting" style="text-align: center">Función</th>
           
        </tr>
        </thead>
        <tbody>
            
        @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->apellidos}}</td>
                <td>{{$user->telefono}}</td>
                <td>{{$user->identidad}}</td>
                <td>@forelse ($user->getRoleNames() as $rol)
                    <span class="badge">{{$rol}}</span>
                    @empty
                    <span class="badge">Sin Rol</span>
                    @endforelse</td>
            </tr>

        @endforeach
    </table>
        </tbody>
        

@stop