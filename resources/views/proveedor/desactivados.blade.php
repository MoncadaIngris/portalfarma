@extends('plantilla.madre')
@section('titulo')
Listado de Proveedores Desactivados
@stop
@section('contenido')
  @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
      <th scope="col">Nombre Repartidor</th>
        <th scope="col">Nombre Proveedor</th>
        <th scope="col">Teléfono Repartidor</th>
        <th scope="col">Dia de Entrega</th>
        <th scope="col">Detalles</th>
        <th scope="col">Activar</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($proveedor as $proveedor)
        <tr>
    
          <td>{{$proveedor->nombre_repartidor}}</td>
          <td>{{$proveedor->nombre_proveedor}}</td>
          <td>{{$proveedor->telefono_repartidor}}</td>
          <td>{{$proveedor->dia_de_entrega}}</td>
          <td><a class="btn btn-success" href="{{route("proveedor.show",["id"=>$proveedor->id])}}">Detalles</a></td>
          <td><a class="btn btn-info" href="{{route("proveedor.activar",["id"=>$proveedor->id])}}">Activar</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop