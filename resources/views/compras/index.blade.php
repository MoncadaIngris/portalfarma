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
      </style>
    <button class="btn btn-nuevo" onclick="window.location='{{route('compras.create')}}'"><i class="fa-solid fa-folder-plus"></i> Nueva Compra</button>
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">Fecha efectuada</th>
            <th scope="col" style="text-align: center">Proveedor</th>
            <th scope="col" style="text-align: center">Sub Total</th>
            <th scope="col" style="text-align: center">Impuesto</th>
            <th scope="col" style="text-align: center">Total</th>
            <th scope="col" style="text-align: center">Detalle</th>

        
        
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
