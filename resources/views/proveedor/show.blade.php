@extends('plantilla.madre')
@section('titulo')
Datos del Proveedor {{$proveedor->nombre_proveedor}}
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
                <div class="container" style="border-style: none!important; background-color: #53b4f5; border-radius: 5px; width: 50em">
                    <hr style="border-top: 2px solid white; border-bottom: 2px solid white; border-left:none; border-right:none; height: 2px; ">
                    <div style="float: left; display: inline-block; margin-top: 5px">

                        <p style="color: black; margin-left: 250px">Nombre Repartidor: <strong style="color: black">{{$proveedor->nombre_repartidor}} </strong></p>
                        <p style="color: black; margin-left: 250px">Nombre Proveedor: <strong style="color: black">{{$proveedor->nombre_proveedor}}</strong></p>
                        <p style="color: black; margin-left: 250px">Correo Electronico: <strong style="color: black">{{$proveedor->correo_electronico}}</strong></p>
                        <p style="color: black; margin-left: 250px">Teléfono Repartidor: <strong style="color: black">{{$proveedor->telefono_repartidor}} </strong> </p>
                        <p style="color: black; margin-left: 250px">Teléfono Proveedor: <strong style="color: black">{{$proveedor->telefono_proveedor}} </strong> </p>
                        <p style="color: black; margin-left: 250px">Dia de Entrega: <strong style="color: black">{{$proveedor->dia_de_entrega}} </strong> </p>
                    </div>
                    </div>
                    <hr>
                    <div  style="margin: 0 auto;">
                        <button class="btn btn-regresar" type="button" onclick="window.location='javascript: history.go(-1)'">Regresar</button>
                    </div>

            </div>
        </div>
@stop
