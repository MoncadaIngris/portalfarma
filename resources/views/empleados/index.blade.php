@extends('plantilla.madre')
@section('titulo')
Listado de Empleados
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
<button class="btn btn-info" onclick="window.location='{{route('empleados.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Empleado</button>
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" style="width: 15%; text-align: center">Identidad</th>
        <th scope="col" style="width: 15%; text-align: center">Nombres</th>
        <th scope="col" style="width: 15%; text-align: center">Apellidos</th>
        <th scope="col" style="width: 15%; text-align: center">Teléfono</th>
        <th scope="col" style="width: 40%; text-align: center">Acción</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($empleados as $empleado)
        <tr>
          <td>{{$empleado->DNI}}</td>
          <td>{{$empleado->nombres}}</td>
          <td>{{$empleado->apellidos}}</td>
          <td>{{$empleado->telefono_personal}}</td>
          <td>
            <center>
              <a class="btn btn-warning" href="{{route("empleado.edit",["id"=>$empleado->id])}}"><i class="fa-solid fa-pen-to-square"></i>Editar</a>
              <a class="btn btn-success" href="{{route("empleado.show",["id"=>$empleado->id])}}"><i class="fa-solid fa-circle-info"></i>Detalles</a>
              <button class="btn btn-danger"><i class="fa-solid fa-eye-slash"></i>Desactivar</button>
            </center>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
