@extends('plantilla.madre')
@section('titulo')
    Listado de Ventas de {{$promocion->productos->nombre}} en promocion
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
    <a class="btn btn-regresar" href="{{route("promociones.vencidas")}}">
        Regresar
    </a>
    <br>
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Fecha</th>
            <th scope="col" class="sorting" style="text-align: center">Cliente</th>
            <th scope="col" class="sorting" style="text-align: center">Cantidad</th>
            <th scope="col" class="sorting" style="text-align: center">Precio</th>
            <th scope="col" class="sorting" style="text-align: center">Total</th>
        </tr>
        </thead>
        <tbody>
            
        @foreach ($ventas as $venta)
            <tr>
                <td style="text-align: center">{{\Carbon\Carbon::parse($venta->created_at)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                <td>{{$venta->ventas->clientes->nombres}}  {{$venta->ventas->clientes->apellidos}}</td>
                <td style="text-align: center">{{$venta->cantidad}}</td>
                <td style="text-align: right">L.{{ number_format($venta->venta,2)}}</td>
                <td style="text-align: right">L.{{ number_format($venta->cantidad * $venta->venta,2)}}</td>
            </tr>

        @endforeach
    </table>
        </tbody>
        

@stop
