@extends('plantilla.madre')
@section('titulo')
    Listado de ventas
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
    @can('ventas_nuevo')
    <button class="btn btn-nuevo" onclick="window.location='{{route('ventas.create')}}'"><i class="fa-solid fa-folder-plus"></i> Nueva venta</button>
    @endcan
    <div style="float: right;margin-right: 10px; width: 250px">
        <p><center>Descargar reporte:</center></p>
    </div>
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Fecha efectuada</th>
            <th scope="col" style="text-align: center">Cliente</th>
            <th scope="col" style="text-align: center">Sub Total</th>
            <th scope="col" style="text-align: center">Impuesto</th>
            <th scope="col" style="text-align: center">Total</th>
            @can('ventas_detalle')
            <th scope="col" class='notexport' style="text-align: center">Detalle</th>
            @endcan
        </tr>
    </thead>

    <tbody>
    @foreach ($ventas as $venta)
        <tr>
            <td>{{date_format($venta->created_at,"d/m/Y")}}</td>
            <td>{{$venta->clientes->nombres}} {{$venta->clientes->apellidos}}</td>
            <td style="text-align: right">L.{{ number_format($venta->subtotal,2)}}</td>
            <td style="text-align: right">L.{{ number_format($venta->impuesto,2)}}</td>
            <td style="text-align: right">L.{{ number_format($venta->total,2)}}</td>
            @can('ventas_detalle')
            <td>
                <center>
                    <a class="btn btn-detalles" href="{{route("ventas.show",["id"=>$venta->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                </center>
            </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>

@stop
