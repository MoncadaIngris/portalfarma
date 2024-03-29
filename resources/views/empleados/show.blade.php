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
    <div style="margin-left: 15%;width: 70%">
        <div>
            <div class="card" style="border-style: none!important; margin-top: 25px">
                <div class="container" style="border-style: none!important; background-color: #53b4f5; border-radius: 5px; width: 60em;">


                    <hr style="border-top: 2px solid white; border-bottom: 2px solid white; border-left:none; border-right:none; height: 2px; ">

                    <div style="margin-left: 10px; float: left;">
                        <img src="{{asset($empleado->fotografia)}}" class="card-img-top" alt=""  width=200px height=200px;>
                    </div>

                    <div  style="float: left; width: 35em">
                        <p style="color: black; margin-left: 20px">Nombre: <strong style="color: black">{{$empleado->nombres}} {{$empleado->apellidos}}</strong></p>
                        <p style="color: black; margin-left: 20px">Correo Electrónico: <strong style="color: black">{{$empleado->correo_electronico}}</strong></p>
                        <p style="color: black; margin-left: 20px">Teléfono Personal: <strong style="color: black">{{$empleado->telefono_personal}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Teléfono Alternativo: <strong style="color: black">{{$empleado->telefono_alternativo}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Fecha de Nacimiento: <strong style="color: black">{{\Carbon\Carbon::parse($empleado->fecha_de_nacimiento)->locale("es")->isoFormat("DD MMMM, YYYY")}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Fecha de Ingreso: <strong style="color: black">{{\Carbon\Carbon::parse($empleado->fecha_de_ingreso)->locale("es")->isoFormat("DD MMMM, YYYY")}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Identidad: <strong style="color: black">{{$empleado->DNI}} </strong> </p>
                        <div style="width: 50px; height: 100px">
                        <p style="color: black; margin-left: 20px">Dirección: <strong style="color: black">{{$empleado->direccion}} </strong> </p>
                        </div>
                    </div>

                </div>
                <hr>
                <div  style="margin: 0 auto;">
                    @if ($empleado->estado == 1)
                    <button class="btn btn-regresar" type="button" onclick="window.location='{{route('empleados.desactivado')}}'">Regresar</button>
                    @else
                    <button class="btn btn-regresar" type="button" onclick="window.location='{{route('empleados.index')}}'">Regresar</button>
                    @endif
                </div>
            </div>
        </div>
@stop

