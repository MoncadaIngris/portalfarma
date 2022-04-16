@extends('plantilla.madre')
@section('titulo')
    Listado de compras
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
    @can('compras_nuevo')
    <button class="btn btn-nuevo" onclick="window.location='{{route('compras.create')}}'"><i class="fa-solid fa-folder-plus"></i> Nueva Compra</button>
    @endcan
    <div style="float: right;margin-right: 10px; width: 250px">
        <p><center>Descargar reporte:</center></p>
    </div>
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Fecha efectuada</th>
            <th scope="col" class="sorting" style="text-align: center">Proveedor</th>
            <th scope="col" class="sorting" style="text-align: center">Sub Total</th>
            <th scope="col" class="sorting" style="text-align: center">Impuesto</th>
            <th scope="col" class="sorting" style="text-align: center">Total</th>
@can('compras_detalle')
<th scope="col" class='notexport' style="text-align: center">Detalle</th>
@endcan
        </tr>
        </thead>

        <tbody>
        @foreach ($compras as $compra)
            <tr>
                <td>{{date_format($compra->created_at,"d/m/Y")}}</td>
                <td>{{$compra->proveedores->nombre_proveedor}}</td>
                <td style="text-align: right">L.{{ number_format($compra->subtotal,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->impuesto,2)}}</td>
                <td style="text-align: right">L.{{ number_format($compra->total,2)}}</td>
                @can('compras_detalle')
                <td>
                    <center>
                        <a class="btn btn-detalles" href="{{route("compras.show",["id"=>$compra->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                    </center>
                </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
