@extends('plantilla.madre')
@section('titulo')
Detalles de Venta
@stop
@section('contenido')
<br>

<div style="float: right;margin-right: 10px; width: 250px">
    <p><center>Descargar reporte:</center></p>
</div>
<table  id="datatable-buttons" class="table table-striped">
    <thead>
<div>
    <div style="float: left; font-size: 20px">
        <label for="">Fecha: </label>
        {{date_format($venta->created_at,"d/m/Y")}}
    </div>
    <div style="float: right;font-size: 20px">
        <label for="">Cliente: </label>
        {{$venta->clientes->nombres}}
    </div>
</div>
<br><br>
<table class="table table-bordered">
    <tr>
       <th style="text-align: center">Producto</th>
       <th style="text-align: center">Código</th>
       <th style="text-align: center">Precio de Venta</th>
       <th style="text-align: center">Cantidad</th>
       <th style="text-align: center">Tasa de Impuesto</th>
       <th style="text-align: center">Sub Total</th>
       <th style="text-align: center">Total</th>
    </tr>
        <?php
        $subtotal =0;
        $impuesto = 0;
        ?>
        @forelse ($productos as $p)
            <tr>
                <td>{{$p->productos->nombre}}</td>
                <td style="text-align: center">{{$p->productos->codigo}}</td>
                <td style="text-align: right">L.{{ number_format($p->venta,2)}}</td>
                <td style="text-align: right">{{$p->cantidad}}</td>
                <td style="text-align: center">{{$p->impuestos->descripcion}}</td>
                <td style="text-align: right">L.{{ number_format($p->venta * $p->cantidad,2)}}</td>
                <?php $subtotal += $p->venta * $p->cantidad;?>
                <td style="text-align: right">L.{{ number_format(($p->venta * $p->cantidad)*(1+$p->impuestos->valor),2)}}</td>
                <?php $impuesto += ($p->venta * $p->cantidad)*$p->impuestos->valor;?>
            </tr>
        @empty
            <tr>
                <td colspan="7"><center>No hay datos</center></td>
            </tr>
        @endforelse
    <tr>
        <td style="text-align: right" colspan="6">Sub Total</td>
        <td style="text-align: right">L.{{ number_format($subtotal,2)}}</td>
    </tr>
    <tr>
        <td style="text-align: right" colspan="6">Impuesto</td>
        <td style="text-align: right">L.{{ number_format($impuesto,2)}}</td>
    </tr>
    <tr>
        <td style="text-align: right" colspan="6">Total</td>
        <td style="text-align: right">L.{{ number_format($subtotal+$impuesto,2)}}</td>
    </tr>
</table>
<a type="button" class="btn btn-regresar" href="{{route('ventas.index')}}">Regresar</a>
@stop
