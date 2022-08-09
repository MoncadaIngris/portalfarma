@extends('plantilla.madre')
@section('titulo')
    Detalle de estantes {{$estante->nombre}}
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
<textarea name="" id="" style="width: 100%;"  rows="2" disabled>Descripción: {{$estante->descripcion}} </textarea>
<br><br>
<table  id="datatable-buttons" class="table table-striped">
    <thead>
    <tr>
        <th scope="col" class="sorting" style="text-align: center">Número de fila</th>
        <th scope="col" class="sorting" style="text-align: center">Número de columna</th>
        <th scope="col" class="sorting" style="text-align: center">Producto</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($informacion as $estante)
        <tr>
        <td>{{$estante->fila}}</td>
        <td>{{$estante->columna}}</td>
        <td>{{$estante->producto}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<button class="btn btn-regresar" type="button" onclick="window.location='{{route('estante.index')}}'">
    Regresar
</button>
@stop
