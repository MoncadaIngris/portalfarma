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
    <div style="margin-left: 15%;width: 70%">
        <div>
            <div class="card" style="border-style: none!important; margin-top: 25px">
                <div class="container" style="border-style: none!important; background-color: #53b4f5; border-radius: 5px; width: 50em">
                    <hr style="border-top: 2px solid white; border-bottom: 2px solid white; border-left:none; border-right:none; height: 2px; ">
                    <div  style="margin-top: 10px; width: 200px ; height: 200px; float: left; display: inline-block; margin-top: 10px; margin-bottom: 1px; margin-left: 20px; margin-right: 10px">
                        <img src="{{asset('images/logodetalles.png')}}" class="card-img-top" alt="" height="80%" >
                    </div>
                    <div style="float: left; display: inline-block; margin-top: 15px">

                        <p style="color: black; margin-left: 20px">Nombre Repartidor: <strong style="color: black">{{$proveedor->nombre_repartidor}} </strong></p>
                        <p style="color: black; margin-left: 20px">Nombre Proveedor: <strong style="color: black">{{$proveedor->nombre_proveedor}}</strong></p>
                        <p style="color: black; margin-left: 20px">Correo Electrónico: <strong style="color: black">{{$proveedor->correo_electronico}}</strong></p>
                        <p style="color: black; margin-left: 20px">Teléfono Repartidor: <strong style="color: black">{{$proveedor->telefono_repartidor}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Teléfono Proveedor: <strong style="color: black">{{$proveedor->telefono_proveedor}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Día de Entrega: <strong style="color: black">{{$proveedor->dia_de_entrega}} </strong> </p>
                    </div>
                    </div>
                    <hr>
                    <div  style="margin: 0 auto;">
                        @if ($proveedor->estado == 1)
                        <button class="btn btn-regresar" type="button" onclick="window.location='{{route('proveedor.desactivado')}}'">Regresar</button>
                        @else
                        <button class="btn btn-regresar" type="button" onclick="window.location='{{route('proveedor.index')}}'">Regresar</button>
                        @endif
                        
                    </div>

            </div>
        </div>
@stop
