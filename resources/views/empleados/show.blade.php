@extends('plantilla.madre')
@section('titulo')
    Datos del Empleado {{$empleado->nombres}} {{$empleado->apellidos}}
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

                    <div  style="margin-top: 10px; width: 300px ; height: 300px; float: left; display: inline-block; margin-top: 10px; margin-bottom: 1px; margin-left: 10px; margin-right: 10px">
                        <img src="{{asset($empleado->fotografia)}}" class="card-img-top" alt="" height="90%" >
                    </div>

                    <div style="float: left; display: inline-block; margin-top: 10px">
                        <p style="color: white; margin-left: 20px">Nombre: <strong style="color: white">{{$empleado->nombres}} {{$empleado->apellidos}}</strong></p>
                        <p style="color: white; margin-left: 20px">Correo Electronico: <strong style="color: white">{{$empleado->correo_electronico}}</strong></p>
                        <p style="color: white; margin-left: 20px">Telefono Personal: <strong style="color: white">{{$empleado->telefono_personal}} </strong> </p>
                        <p style="color: white; margin-left: 20px">Telefono Alternativo: <strong style="color: white">{{$empleado->telefono_alternativo}} </strong> </p>
                        <p style="color: white; margin-left: 20px">Fecha de Nacimiento: <strong style="color: white">{{\Carbon\Carbon::parse($empleado->fecha_de_nacimiento)->locale("es")->isoFormat("DD MMMM, YYYY")}} </strong> </p>
                        <p style="color: white; margin-left: 20px">Identidad: <strong style="color: white">{{$empleado->DNI}} </strong> </p>
                        <p style="color: white; margin-left: 20px">Direccion: <strong style="color: white">{{$empleado->direccion}} </strong> </p>

                    </div>

                </div>
                <hr>
                <div  style="margin: 0 auto;">
                    <button class="btn btn-primary" type="button" onclick="window.location='javascript: history.go(-1)'">Regresar</button>
                </div>
            </div>
        </div>
@stop

