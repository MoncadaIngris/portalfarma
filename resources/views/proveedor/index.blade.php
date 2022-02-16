@extends('plantilla.madre')
@section('titulo')
Listado de Proveedores
@stop
@section('contenido')
  @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
<button class="btn btn-info" onclick="window.location='{{route('proveedor.create')}}'">Crear Nuevo</button>
<table  id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nombre Repartidor</th>
        <th scope="col">Nombre Proveedor</th>
        <th scope="col">Teléfono Repartidor</th>
        <th scope="col">Dia de Entrega</th>
        <th scope="col">Editar</th>
        <th scope="col">Detalles</th>
        <th scope="col">Desactivar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($proveedor as $proveedor)
        <tr>

          <td>{{$proveedor->nombre_repartidor}}</td>
          <td>{{$proveedor->nombre_proveedor}}</td>
          <td>{{$proveedor->telefono_repartidor}}</td>
          <td>{{$proveedor->dia_de_entrega}}</td>
          <td><a class="btn btn-warning" href="{{route("proveedor.edit",["id"=>$proveedor->id])}}">Editar</a></td>
          <td><a class="btn btn-success" href="{{route("proveedor.show",["id"=>$proveedor->id])}}">Detalles</a></td>
          <td><button class="btn btn-danger" href= "{{route("proveedor.desactivar",["id"=>$proveedor->id])}}">Desactivar</button></td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
