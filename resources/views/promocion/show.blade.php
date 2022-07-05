@extends('plantilla.madre')
@section('titulo')
Detalle de la promoción de: {{$promocion->productos->nombre}}
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

                        <p style="color: black; margin-left: 20px">Nombre Del Producto: <strong style="color: black">{{$promocion->productos->nombre}} </strong></p>
                        <p style="color: black; margin-left: 20px">Código Del Producto: <strong style="color: black"> {{$promocion->productos->codigo}}  </strong></p>
                        <p style="color: black; margin-left: 20px">Precio Del Producto: <strong style="color: black"> L.{{ number_format($promocion->anterior,2)}} </strong></p>
                     <p style="color: black; margin-left: 20px">Nuevo Precio:  <strong style="color: black">L.{{ number_format($promocion->nuevo,2)}}</strong>
                        <p style="color: black; margin-left: 20px">Fecha de creación de promoción:  <strong style="color: black">{{$promocion->created_at->locale("es")->isoFormat("DD MMMM YYYY")}}</strong>
                        <p style="color: black; margin-left: 20px">Descuento:  <strong style="color: black">L.{{ $promocion->anterior - $promocion->nuevo}} </strong>
         
                    </p>
        



                    </div>
                    </div>
                    <hr>
                    <div  style="margin: 0 auto;">

                        <button class="btn btn-regresar" type="button" onclick="window.location='{{route('promociones.index')}}'">Regresar</button>

                    </div>

            </div>
        </div>
@stop
