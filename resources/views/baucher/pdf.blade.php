<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Generate PDF From View</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<style>
    table{
        font-size: 18px;
    }
</style>


<body>
    <h1><center>{{ $title }}</center></h1>

<br><br><br>
    <table style="width: 100%">
        <tr>
            <td>
                <label for=""><Strong>Nombre del empleado: </Strong></label>
                <label for="">{{$baucher->empleados->nombres}} {{$baucher->empleados->apellidos}}</label>
            </td>
            <td>
                <label for=""><Strong>Identidad del empleado: </Strong></label>
                <label for="">{{$baucher->empleados->DNI}}</label>
            </td>
            <td>
                <label for=""><Strong>Cargo del empleado: </Strong></label>
                <label for="">{{$baucher->empleados->cargos->descripcion}}</label>
            </td>
        </tr>
        <tr>
            <td>
                <label for=""><Strong>Fecha de inicio: </Strong></label>
                <label for="">{{$baucher->planillas->fecha_inicio}}</label>
            </td>
            <td>
                <label for=""><Strong>Fecha final: </Strong></label>
                <label for="">{{$baucher->planillas->fecha_final}}</label>
            </td>
            <td>
                <label for=""><Strong>Telefono de empleado: </Strong></label>
                <label for="">{{$baucher->empleados->telefono_personal}}</label>
            </td>
        </tr>
    </table>
    <br><br>
    <table style="width: 40%;float: left;">
        <tr>
            <td style="text-align: center" colspan="3"><strong>Ingresos</strong></td>
        </tr>
        <tr>
            <td><strong><i>Descripcion</i></strong></td>
            <td style="text-align: right"><strong><i>Cantidad</i></strong></td>
            <td style="text-align: right"><strong><i>Total</i></strong></td>
        </tr>
        <tr>
            <td>Horas ordinarias</td>
            <td style="text-align: right">{{number_format($baucher->hora_ordinaria,2)}}</td>
            <td style="text-align: right">{{number_format($baucher->hora_ordinaria*$baucher->precio_hora,2)}}</td>
        </tr>
        <tr>
            <td>Horas extra</td>
            <td style="text-align: right">{{number_format($baucher->hora_extra,2)}}</td>
            <td style="text-align: right">{{number_format($baucher->hora_extra*$baucher->precio_hora,2)}}</td>
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
            <td><strong><i>Descripcion</i></strong></td>
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
    <br><br><br><br><br><br><br><br><br>
    <div style="width: 100%;text-align: center">
        <h3>
            El total a pagar para el empleado {{$baucher->empleados->nombres}} {{$baucher->empleados->apellidos}} con identidad
            {{$baucher->empleados->DNI}} recibio un sueldo de L. 
            {{number_format((($baucher->hora_extra*$baucher->precio_hora)+($baucher->hora_ordinaria*$baucher->precio_hora))-$baucher->deducciones,2)}}
        </h3>
    </div>
    

</body>
</html>
