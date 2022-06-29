@extends('plantilla.madre')
@section('titulo')
    Baucher
@stop
@section('contenido')

<style>
    table tr td {
        font-size: 17px;
    }
</style>

<div style="float: right;margin-right: 10px; width: 130px">
    <p><center>Descargar:</center></p>
    <div class="dt-buttons btn-group">
        <center>
            <a class="btn btn-default buttons-pdf buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons" href="{{route('baucher.pdf',['planilla'=>$baucher->planillas->id])}}"><span>PDF</span></a>
            <a class="btn btn-default buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons" href="javaScript:printDiv()"><span>Imprimir</span></a>
        </center>
    </div>
</div>
<script>
    function printDiv() {
        var divContents = document.getElementById("GFG").innerHTML;
        var a = window.open('', '', 'height=1000, width=1000');
        a.document.write('<html>');
        a.document.write('<body > <h1><center>Baucher  del  {{$baucher->planillas->fecha_inicio}} al {{$baucher->planillas->fecha_final}} <br> <center><br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.focus();
        a.print();
        a.close();
    }
</script>
<br><br><br><br>
<div id="GFG">
    <link href="{{ asset('css/bootstrapcdn.css') }}" rel="stylesheet">
    <table style="width: 100%">
        <tr>
            <td>
                <label for=""><Strong>Nombre del empleado: </Strong></label>
                {{$baucher->empleados->nombres}} {{$baucher->empleados->apellidos}}
            </td>
            <td>
                <label for=""><Strong>Identidad del empleado: </Strong></label>
                {{$baucher->empleados->DNI}}
            </td>
            <td>
                <label for=""><Strong>Cargo del empleado: </Strong></label>
                {{$baucher->empleados->cargos->descripcion}}
            </td>
        </tr>
        <tr>
            <td>
                <label for=""><Strong>Fecha de inicio: </Strong></label>
                {{\Carbon\Carbon::parse($baucher->planillas->fecha_inicio)->locale("es")->isoFormat("DD MMMM YYYY")}}
            </td>
            <td>
                <label for=""><Strong>Fecha final: </Strong></label>
                {{\Carbon\Carbon::parse($baucher->planillas->fecha_final)->locale("es")->isoFormat("DD MMMM YYYY")}}

            </td>
            <td>
                <label for=""><Strong>Teléfono de empleado: </Strong></label>
                {{$baucher->empleados->telefono_personal}}
            </td>
        </tr>
    </table>
    <br><br>
    <table style="width: 40%;float: left;">
        <tr>
            <td style="text-align: center" colspan="3"><strong>Ingresos</strong></td>
        </tr>
        <tr>
            <td><strong><i>Descripción</i></strong></td>
            <td style="text-align: right"><strong><i>Cantidad</i></strong></td>
            <td style="text-align: right"><strong><i>Total</i></strong></td>
        </tr>
        <tr>
            <td>Horas ordinarias</td>
            <td style="text-align: right">{{number_format($baucher->hora_ordinaria,2)}}</td>
            <td style="text-align: right">L. {{number_format($baucher->hora_ordinaria*$baucher->precio_hora,2)}}</td>
        </tr>
        <tr>
            <td>Horas extra</td>
            <td style="text-align: right">{{number_format($baucher->hora_extra,2)}}</td>
            <td style="text-align: right">L. {{number_format($baucher->hora_extra*$baucher->precio_hora,2)}}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td style="text-align: right">{{number_format($baucher->hora_extra+$baucher->hora_ordinaria,2)}}</td>
            <td style="text-align: right">L. {{number_format(($baucher->hora_extra*$baucher->precio_hora)+($baucher->hora_ordinaria*$baucher->precio_hora),2)}}</td>
        </tr>
    </table>
    
    <table style="width: 40%; float: right;">
        <tr>
            <td style="text-align: center" colspan="3"><strong>Egresos</strong></td>
        </tr>
        <tr>
            <td><strong><i>Descripción</i></strong></td>
            <td style="text-align: right"><strong><i>Cantidad</i></strong></td>
            <td style="text-align: right"><strong><i>Total</i></strong></td>
        </tr>
        <tr>
            <td>Deducciones</td>
            <td></td>
            <td style="text-align: right">L. {{number_format($baucher->deducciones,2)}}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td></td>
            <td style="text-align: right">L. {{number_format($baucher->deducciones,2)}}</td>
        </tr>
    </table>
    <br><br><br><br>
    <div style="float: left; text-align: center; width: 100%">
        <h3>
            El empleado {{$baucher->empleados->nombres}} {{$baucher->empleados->apellidos}} recibio un sueldo de L. 
            {{number_format((($baucher->hora_extra*$baucher->precio_hora)+($baucher->hora_ordinaria*$baucher->precio_hora))-$baucher->deducciones,2)}}
        </h3>
    </div>
</div>
<br><br>
@stop
