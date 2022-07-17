@extends('plantilla.madre')
@section('titulo')
    Listado de filas de estantes
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
            
            <th scope="col" class="sorting" style="text-align: center">Número de fila</th>
            <th scope="col" class="sorting" style="text-align: center">Número de columna</th>
            <th scope="col" style="text-align: center">Detalles</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($estantes as $estante)
            <tr>
            <td>{{$estante->fila}}</td>
            <td>{{$estante->columna}}</td>
            <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
