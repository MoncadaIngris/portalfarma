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
    </tr>>
    <tr>
        <td>
            <label for=""><Strong>Fecha de inicio: </Strong></label>
            {{$baucher->planillas->fecha_inicio}}
        </td>
        <td>
            <label for=""><Strong>Fecha final: </Strong></label>
            {{$baucher->planillas->fecha_final}}
        </td>
        <td>
            <label for=""><Strong>Telefono de empleado: </Strong></label>
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
        <td><strong><i>Descripcion</i></strong></td>
        <td><strong><i>Cantidad</i></strong></td>
        <td><strong><i>Total</i></strong></td>
    </tr>
    <tr>
        <td>Horas ordinarias</td>
        <td>{{$baucher->hora_ordinaria}}</td>
        <td>{{$baucher->hora_ordinaria*$baucher->precio_hora}}</td>
    </tr>
    <tr>
        <td>Horas extra</td>
        <td>{{$baucher->hora_extra}}</td>
        <td>{{$baucher->hora_extra*$baucher->precio_hora}}</td>
    </tr>
    <tr>
        <td>Total</td>
        <td>{{$baucher->hora_extra+$baucher->hora_ordinaria}}</td>
        <td>{{($baucher->hora_extra*$baucher->precio_hora)+($baucher->hora_ordinaria*$baucher->precio_hora)}}</td>
    </tr>
</table>

<table style="width: 40%; float: right;">
    <tr>
        <td style="text-align: center" colspan="3"><strong>Egresos</strong></td>
    </tr>
    <tr>
        <td><strong><i>Descripcion</i></strong></td>
        <td><strong><i>Cantidad</i></strong></td>
        <td><strong><i>Total</i></strong></td>
    </tr>
    <tr>
        <td>Deducciones</td>
        <td></td>
        <td>{{$baucher->deducciones}}</td>
    </tr>
    <tr>
        <td>Total</td>
        <td></td>
        <td>{{$baucher->deducciones}}</td>
    </tr>
</table>
<br><br>
<div style="float: left">
    <h3>
        El total a pagar para el empleado {{$baucher->empleados->nombres}} {{$baucher->empleados->apellidos}} con identidad
        {{$baucher->empleados->DNI}} recibio un sueldo de L. 
        {{number_format((($baucher->hora_extra*$baucher->precio_hora)+($baucher->hora_ordinaria*$baucher->precio_hora))-$baucher->deducciones,2)}}
    </h3>
</div>

@stop