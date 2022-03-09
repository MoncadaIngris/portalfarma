@extends('plantilla.madre')
@section('titulo')
    Listado de clientes
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
    <button class="btn btn-nuevo" onclick="window.location='{{route('clientes.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Cliente</button>

    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Identidad</th>
            <th scope="col" style="text-align: center">Nombres</th>
            <th scope="col" style="text-align: center">Apellidos</th>
            <th scope="col" style="text-align: center">Teléfono</th>
            <th scope="col" style="text-align: center">Editar</th>
            <th scope="col" style="text-align: center">Detalles</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{$cliente->DNI}}</td>
                <td>{{$cliente->nombres}}</td>
                <td>{{$cliente->apellidos}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>
                    <center>
            <a class="btn btn-editar" href="{{route("clientes.edit",["id"=>$cliente->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
                <td>
                    <center>
            <a class="btn btn-detalles" href="{{route("clientes.show",["id"=>$cliente->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
