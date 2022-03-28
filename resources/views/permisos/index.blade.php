@extends('plantilla.madre')
@section('titulo')
    Lista De Permisos
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
    <button class="btn btn-nuevo" onclick="window.location='{{route('permisos.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Permiso</button>
    <table  id="datatable" class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Nombre</th>
            <th scope="col" class="sorting" style="text-align: center">Descripción</th>
            <th scope="col" style="text-align: center">Editar</th>

        </tr>
        </thead>

        <tbody>
        @foreach ($permisos as $permisos)
            <tr>

                <td>{{$permisos->titulo}}</td>
                <td>{{$permisos->name}}</td>


                <td>
                    <center>
            <a class="btn btn-editar" href="{{route("permisos.edit",["id"=>$permisos->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
    </tr>

    @endforeach
    </tbody>
    </table>
@stop
