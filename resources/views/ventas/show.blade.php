@extends('plantilla.madre')
@section('titulo')
Detalles de Venta
@stop
@section('contenido')
<div id="GFG">
    <style>
        .round_table {                   
            border-collapse: separate;
            border-spacing: 10;
            border: 1px solid black;
            border-radius: 15px;
            -moz-border-radius: 20px;
            padding: 2px;
            -webkit-border-radius: 5px;
        }
    </style>
    <link href="{{ asset('css/bootstrapcdn.css') }}" rel="stylesheet">
    <br>
    <div style="float: left; font-size: 14px; width: 80%">
        <label style="float: left;width: 20%" for="">Nombre del Cliente:  </label>
        <p style="float: left;border-bottom: solid 1px #000;width: 80%">{{$venta->clientes->nombres}} {{$venta->clientes->apellidos}}</p>
        <label style="float: left;width: 20%" for="">Dirección:  </label>
        <p style="float: left;border-bottom: solid 1px #000;width: 80%">{{$venta->clientes->direccion}}</p>     
    </div>
    <div style="float: left; font-size: 14px; width: 20%"> 
        <center>
            Fecha:
            <table class="" style="width: 60%">
                <tr>
                    <th style="width: 25%;text-align: center">Dia</th>
                    <th style="width: 7.5%;"></th>
                    <th style="width: 25%;text-align: center">Mes</th>
                    <th style="width: 7.5%"></th>
                    <th style="width: 35%;text-align: center">Año</th>
                </tr>
                <tr>
                    <td style="text-align: center">{{date_format($venta->created_at,"d")}}</td>
                    <td style="text-align: center">/</td>
                    <td style="text-align: center">{{date_format($venta->created_at,"m")}}</td>
                    <td style="text-align: center">/</td>
                    <td style="text-align: center">{{date_format($venta->created_at,"Y")}}</td>
                </tr>
            </table>
        </center>
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
</div>
<a type="button" class="btn btn-regresar" href="{{route('ventas.index')}}">Regresar</a>
<button type="button" onclick="printDiv()" class="btn btn-guardar">Imprimir</button>

<script>
    function printDiv() {
        var divContents = document.getElementById("GFG").innerHTML;
        var a = window.open('', '', 'height=1000, width=1000');
        a.document.write('<html>');
        a.document.write('<body > <h1><center>PORTALFARMA</center></h1>');
        a.document.write('<center><p>El Paraíso, El Paraíso barrio San Isidro, 1/2 abajo del Instituto Armando Martinez</p></center>');
        a.document.write('<p style="float:left"><strong>Telefono: </strong> 2974-2782 / 9189-2989 / 3827-9181</p>');
        a.document.write('<p style="float:right"><strong>Factura: </strong>{{substr(str_repeat(0, 5).$venta->id, - 5)}}</p>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.focus();
        a.print();
        a.close();

    }
</script>

@stop
