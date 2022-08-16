@extends('plantilla.madre')
@section('titulo')
Listado histórico de Empleados en vacaciones
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
      .dt-buttons{
            float: right !important;
        }
    </style>
<table  id="datatable-buttons" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="sorting" style="text-align: center">Nombre empleado</th>
        <th scope="col" class="sorting" style="text-align: center">Apellido empleado</th>
        <th scope="col" class="sorting" style="text-align: center">Identidad</th>
        <th scope="col" class="sorting" style="text-align: center">Teléfono</th>
        <th scope="col" class="sorting" style="text-align: center">Inicio de vacaciones</th>
        <th scope="col" class="sorting" style="text-align: center">Final de vacaciones</th>
        <th scope="col" class="sorting" style="text-align: center">Días de vacaciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->nombres}}</td>
                <td>{{$empleado->apellidos}}</td>
                <td>{{$empleado->DNI}}</td>
                <td>{{$empleado->telefono_personal}}</td>
                <td>{{\Carbon\Carbon::parse($empleado->inicio)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                <td>{{\Carbon\Carbon::parse($empleado->final)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                <td>{{$empleado->dias}} días</td>
    @endforeach
    </tbody>
  </table>
@stop
