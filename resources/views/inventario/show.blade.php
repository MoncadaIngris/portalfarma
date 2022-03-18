@foreach ($producto as $productos)
@extends('plantilla.madre')
@section('titulo')
Datos del Producto {{$productos->nombre}}
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
                    <div  style="margin-top: 10px; width: 250px ; height: 250px; float: left; display: inline-block; margin-top: 10px; margin-bottom: 1px; margin-left: 20px; margin-right: 10px">
                        <img src="{{asset('images/detall.jpeg')}}" class="card-img-top" alt="" height="90%" >
                    </div>
                    <div style="float: left; display: inline-block; margin-top: 40px">

                        <p style="color: black; margin-left: 20px">Nombre: <strong style="color: black">{{$productos->nombre}} </strong></p>
                        <p style="color: black; margin-left: 20px">Código: <strong style="color: black">{{$productos->codigo}}</strong></p>
                        <p style="color: black; margin-left: 20px">Concentración: <strong style="color: black">{{$productos->concentraciones}}</strong></p>
                        <p style="color: black; margin-left: 20px">Receta: 
                            <strong style="color: black">
                                @if ($productos->receta==0)
                                    No
                                @else
                                    Si
                                @endif
                            </strong> 
                        </p>
                        <p style="color: black; margin-left: 20px">Descripción: <strong style="color: black">{{$productos->descripcion}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Cantidad: <strong style="color: black">{{$productos->cantidad}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Precio de venta: <strong style="color: black">L.{{ number_format($productos->venta,2)}} </strong> </p>
                        <p style="color: black; margin-left: 20px">Precio de compra: <strong style="color: black">L.{{ number_format($productos->compra,2)}} </strong> </p>
                    </div>
                    </div>
                    <hr>
                    <div  style="margin: 0 auto;">

                        <button class="btn btn-regresar" type="button" onclick="window.location='{{route('inventario')}}'">Regresar</button>

                    </div>

            </div>
        </div>
@stop

@endforeach