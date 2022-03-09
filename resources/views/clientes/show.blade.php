@extends('plantilla.madre')
@section('titulo')
Datos del Cliente {{$clientes->nombre}}
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
                    <div  style="margin-top: 10px; width: 200px ; height: 200px; float: left; display: inline-block; margin-top: 10px; margin-bottom: 1px; margin-left: 20px; margin-right: 10px">
                        <img src="{{asset('images/cliente.png')}}" class="card-img-top" alt="" height="90%" >
                    </div>
                    <div style="float: left; display: inline-block; margin-top: 40px">

                        <p style="color: black; margin-left: 20px">Nombre: <strong style="color: black">{{$clientes->nombres}} </strong></p>
                        <p style="color: black; margin-left: 20px">Apellidos: <strong style="color: black">{{$clientes->apellidos}}</strong></p>
                        <p style="color: black; margin-left: 20px">Teléfono: <strong style="color: black">{{$clientes->telefono}}</strong></p>
                        <p style="color: black; margin-left: 20px">Identidad: <strong style="color: black">{{$clientes->DNI}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Dirección: <strong style="color: black">{{$clientes->direccion}} </strong> </p>

                        </div>        
                    </div>
                    <hr>
                    <div  style="margin: 0 auto;">

                        <button class="btn btn-regresar" type="button" onclick="window.location='{{route('clientes.index')}}'">Regresar</button>

                    </div>

            </div>
        </div>
@stop
