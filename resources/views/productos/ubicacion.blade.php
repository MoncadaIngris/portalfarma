@extends('plantilla.madre')
@section('titulo')
   Ubicacion de producto
@stop
@section('contenido')

<table  id="datatable" class="table table-striped">
    <thead>
    <tr>

        <th scope="col" class="sorting" style="text-align: center">Producto</th>
        <th scope="col" class="sorting" style="text-align: center">Número de fila</th>
        <th scope="col" class="sorting" style="text-align: center">Número de columna</th>
       
    </tr>
    </thead>

    <tbody>
    @foreach ($producto as $estante)
        <tr>
        
        <td>{{$estante->nombre}}</td>
        <td>{{$estante->filas->numero}}</td>
        <td>{{$estante->columnas->numero}}</td>
        
        </tr>
    @endforeach
    </tbody>
</table>

@stop
