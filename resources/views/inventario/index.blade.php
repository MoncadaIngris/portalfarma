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
        .dt-buttons{
            float: right !important;
        }
      </style>
    <button class="btn btn-nuevo" onclick="window.location='{{route('compras.create')}}'"><i class="fa-solid fa-folder-plus"></i> Nueva Compra</button>
    <div style="float: right;margin-right: 10px; width: 250px">
        <p><center>Descargar reporte:</center></p>
    </div>
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Producto</th>
            <th scope="col" class="sorting" style="text-align: center">Codigo</th>
            <th scope="col" class="sorting" style="text-align: center">Cantidad</th>
            <th scope="col" class="sorting" style="text-align: center">Precio de venta</th>
            <th scope="col" class="sorting" style="text-align: center">Total</th>
            @can('inventarios_detalle')
            <th scope="col" class='notexport' style="text-align: center">Detalle</th>
            @endcan

        
        
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
                @can('inventarios_detalle')
                <td>
                    <center>
                        <a class="btn btn-detalles" href="{{route("inventario.show",["id"=>$compra->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                    </center>
                </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
