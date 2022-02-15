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
        <div>
            <div class="card" style="border-style: none!important; margin-top: 25px">
                <div class="container" style="border-style: none!important; background-color: #151E6D; border-radius: 5px; width: 42rem">
                    <hr style="border-top: 2px solid white; border-bottom: 2px solid white; border-left:none; border-right:none; height: 2px; ">
                    <div style="float: left; display: inline-block; margin-top: 5px">
                    <tr>
                    <p style="color: white; margin-left: 250px">Nombre Repartidor: <strong style="color: white">{{$proveedor->nombre_repartidor}} </strong></p>
                        <p style="color: white; margin-left: 250px">Nombre Proveedor: <strong style="color: white">{{$proveedor->nombre_proveedor}}</strong></p>
                        <p style="color: white; margin-left: 250px">Correo Electronico: <strong style="color: white">{{$proveedor->correo_electronico}}</strong></p>
                        <p style="color: white; margin-left: 250px">Teléfono Repartidor: <strong style="color: white">{{$proveedor->telefono_repartidor}} </strong> </p>
                        <p style="color: white; margin-left: 250px">Teléfono Proveedor: <strong style="color: white">{{$proveedor->telefono_proveedor}} </strong> </p>
                        <p style="color: white; margin-left: 250px">Dia de Entrega: <strong style="color: white">{{$proveedor->dia_de_entrega}} </strong> </p>
                    </div
                    </div>
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>

                    <a type="button" class="btn btn-primary" href="{{route('proveedor.index')}}">Regresar</a>

            </div>
        </div>
@stop
