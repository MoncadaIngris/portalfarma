@extends('plantilla.madre')
@section('titulo')
    Listado de estantes
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
    @can('empleados_nuevo')
    <button class="btn btn-nuevo" onclick="window.location='{{route('estante.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Estante</button>
    @endcan
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Nombre</th>
            <th scope="col" class="sorting" style="text-align: center">Número de fila</th>
            <th scope="col" class="sorting" style="text-align: center">Número de columna</th>
            <th scope="col" style="text-align: center">Editar</th>
            <th scope="col" style="text-align: center">Filas</th>
            <th scope="col" style="text-align: center">Detalles</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($estantes as $estante)
            <tr>
            <td>{{$estante->nombre}}</td>
            <td>{{$estante->fila}}</td>
            <td>{{$estante->columna}}</td>
            <td>
                    <center>
            <a class="btn btn-editar" href="{{route("estante.edit",["id"=>$estante->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
            <td>
            <center>
            <a class="btn btn-guardar" href="{{route("estante.listado",["id"=>$estante->id])}}"><i class="fa-solid fa-bars"></i></a>
                    </center>
            </td>
            <td>
                <center>
                    <a class="btn btn-detalles" href="{{route("estante.detalles",["id"=>$estante->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                </center>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
