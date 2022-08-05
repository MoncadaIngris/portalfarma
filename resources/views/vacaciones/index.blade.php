@extends('plantilla.madre')
@section('titulo')
Listado de Empleados en vacaciones
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
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="sorting" style="text-align: center">Nombre empleado</th>
        <th scope="col" class="sorting" style="text-align: center">Apellido empleado</th>
        <th scope="col" class="sorting" style="text-align: center">Identidad</th>
        <th scope="col" class="sorting" style="text-align: center">Teléfono</th>
        <th scope="col" class="sorting" style="text-align: center">Inicio de vacaciones</th>
        <th scope="col" class="sorting" style="text-align: center">Final de vacaciones</th>
        <th scope="col" style="text-align: center">Editar</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->nombres}}</td>
                <td>{{$empleado->apellidos}}</td>
                <td>{{$empleado->DNI}}</td>
                <td>{{$empleado->telefono_personal}}</td>
                <td>{{$empleado->inicio}}</td>
                <td>{{$empleado->final}}</td>
                <td>
                        <center>
                <a class="btn btn-editar" href="{{route("vacaciones.edit",["id"=>$empleado->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        </center>
                    </td>
    @endforeach
    </tbody>
  </table>
@stop
