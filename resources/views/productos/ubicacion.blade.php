@extends('plantilla.madre')
@section('titulo')
   Ubicación de producto
@stop
@section('contenido')
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

        <th scope="col" class="sorting" style="text-align: center">Producto</th>
        <th scope="col" class="sorting" style="text-align: center">Codigo</th>
        <th scope="col" class="sorting" style="text-align: center">Estante</th>
        <th scope="col" class="sorting" style="text-align: center">Número de fila</th>
        <th scope="col" class="sorting" style="text-align: center">Número de columna</th>
       
    </tr>
    </thead>

    <tbody>
    @foreach ($producto as $estante)
        <tr>
        
        <td>{{$estante->nombre}}</td>
        <td>{{$estante->codigo}}</td>
        <td>{{$estante->estantes->nombre}}</td>
        <td>{{$estante->filas->numero}}</td>
        <td>{{$estante->columnas->numero}}</td>
        
        </tr>
    @endforeach
    </tbody>
</table>

@stop
