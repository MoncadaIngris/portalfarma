@extends('plantilla.madre')
@section('titulo')
    Inventario
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
      
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Producto</th>
            <th scope="col" style="text-align: center">Codigo</th>
            <th scope="col" style="text-align: center">Cantidad</th>
            <th scope="col" style="text-align: center">Precio de venta</th>
            <th scope="col" style="text-align: center">Detalle</th>

        
        
        </tr>
        </thead>

        <tbody>
        @foreach ($productos as $compra)
            <tr>
                <td>{{$compra->nombre}}</td>
                <td>{{$compra->codigo}}</td>
                <td style="text-align: right">{{$compra->cantidad}}</td>
                <td style="text-align: right">L.{{ number_format($compra->venta,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->total,2)}}</td>
                <td>
                    <center>
                        <a class="btn btn-detalles" href="{{route("compras.show",["id"=>$compra->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                    </center>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
