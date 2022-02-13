@extends('plantilla.madre')

@section('titulo')
    Datos del Proveedor {{$proveedor->id}}
@stop

@section('contenido')
    @if(session('mensaje'))

        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
    <div class="container">
        <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col", stile= "color:white "> Campo</th>
      <th scope="col">Valor</th>
    </tr>
  </thead>
  <tbody>

<tr>
      <td scope="col">Nombre del Repartidor</td>
      <td scope="col">{{$proveedor->nombre_repartidor}}</td>
    </tr>

    <tr>
      <td scope="col">Nombre del Proveedor</td>
      <td scope="col">{{$proveedor->nombre_proveedor}}</td>
    </tr>

    <tr>
      <td scope="col">Telefono del Repartidor</td>
      <td scope="col">{{$proveedor->telefono_repartidor}}</td>
    </tr>

    <tr>
      <td scope="col">Dia de Entrega</td>
      <td scope="col">{{$proveedor->dia_de_entrega}}</td>
    </tr>
</tbody>
</table>

<a type="button" class="btn btn-primary" href="{{route('proveedor.index')}}">Regresar</a>

@stop
