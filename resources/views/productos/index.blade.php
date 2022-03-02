@extends('plantilla.madre')
@section('titulo')
    Listado de productos
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
    <button class="btn btn-nuevo" onclick="window.location='{{route('productos.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Productos</button>
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Nombre</th>
            <th scope="col" style="text-align: center">Codigo</th>
            <th scope="col" style="text-align: center">Concentracion</th>
            <th scope="col" style="text-align: center">Receta</th>
            <th scope="col" style="text-align: center">Editar</th>
            <th scope="col" style="text-align: center">Detalles</th>

        </tr>
        </thead>

        <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->codigo}}</td>
                <td>{{$producto->concentraciones->descripcion}}</td>
                <td>
                    @if ($producto->receta==0)
                        No
                    @else
                        Si
                    @endif
                </td>
                <td>
                    <center>
            <a class="btn btn-editar" href="{{route("productos.edit",["id"=>$producto->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
                <td>
                    <center>
            <a class="btn btn-detalles" href="{{route("productos.show",["id"=>$producto->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach

@stop
