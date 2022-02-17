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
<button class="btn btn-info" onclick="window.location='{{route('empleados.create')}}'">Crear Nuevo</button>
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">DNI</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Editar</th>
        <th scope="col">Detalles</th>
        <th scope="col">Desactivar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($empleados as $empleado)
        <td>
          <td>{{$empleado->DNI}}</td>
          <td>{{$empleado->nombres}}</td>
          <td>{{$empleado->apellidos}}</td>
          <td>{{$empleado->telefono_personal}}</td>
          <td><a class="btn btn-warning" href="{{route("empleado.edit",["id"=>$empleado->id])}}">Editar</a></td>
          <td><a class="btn btn-success" href="{{route("empleado.show",["id"=>$empleado->id])}}">Detalles</a></td>
        <button onclick="" class="btn btn-danger"><i class="fa-solid fa-eye-slash"></i>Desactivar</button>
        </center>


        </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
