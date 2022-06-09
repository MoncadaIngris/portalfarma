@extends('plantilla.madre')
@section('titulo')
    Listado Laboral
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
    
    @if (isset($alerta))
    <div class="alert alert-danger" role="alert">
        {{$alerta}}
      </div>
    @else
        @if (isset($confirmacion))
        <div class="alert alert-success" role="alert">
            {{$confirmacion}}
          </div>
        @endif
    @endif

    <form method="post">
        @csrf
        <button class="btn btn-nuevo" type="submit"> Cargar empleados de la fecha actual</button>
    </form>
    <br><br>
    <table  id="datatable-buttons" class="table table-striped">
        <thead>
        <tr>
            <th scope="col"  style="text-align: center; width: 5%">N°</th>
            <th scope="col" class="sorting" style="text-align: center; width: 20%">Nombres</th>
            <th scope="col" class="sorting" style="text-align: center; width: 12%">Fecha</th>
            <th scope="col" class="sorting" style="text-align: center; width: 12%">Hora de Entrada</th>
            <th scope="col" class="sorting" style="text-align: center; width: 12%">Hora de Salida</th>
            <th scope="col" class="sorting" style="text-align: center; width: 12%">Hora Ordinarias</th>
            <th scope="col" class="sorting" style="text-align: center; width: 12%">Hora Extras</th>
            <th scope="col" style="text-align: center; width: 15%">Acción</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($laborales as $contador => $laboral)
            <tr>
                <td>{{$contador+1}}</td>
                <td>{{$laboral->empleado->nombres}} {{$laboral->empleado->apellidos}}</td>
                <td>{{date("d-m-Y", strtotime($laboral->fecha))}}</td>
                @if (isset($laboral->entrada->hora))
                <?php
                    $timezone = new DateTimeZone('America/Tegucigalpa');
                    $inicio = new DateTime('2000-01-01'.$laboral->entrada->hora);
                ?>
                @endif
                @if (isset($laboral->entrada->hora) && isset($laboral->salida->hora))
                <?php
                $final = new DateTime('2000-01-01'.$laboral->salida->hora);
                if ($laboral->entrada->hora > $laboral->salida->hora) {
                    $final = new DateTime('2000-01-02'.$laboral->salida->hora);
                }
                    $diferencia = $inicio->diff($final);
                ?>
                @endif
                <td>
                    @if (isset($laboral->entrada->hora))
                    {{$inicio->format('H:i:s');}}
                    @else
                        No registrada
                    @endif
                </td>
                <td>
                    @if (isset($laboral->salida->hora))
                    {{$final->format('H:i:s');}}
                    @else
                        No registrada
                    @endif
                </td>
                <td>
                    @if (isset($laboral->entrada->hora) && isset($laboral->salida->hora))
                        @if ($diferencia->format("%h")> 8)
                        {{$diferencia->format("8 houras y 0 minutos");}}
                        @else
                        {{$diferencia->format("%h houras y %i minutos");}}
                        @endif
                    @else
                        No registrada
                    @endif
                </td>
                <td>
                    @if (isset($laboral->entrada->hora) && isset($laboral->salida->hora))
                    @if ($diferencia->format("%h")> 8)
                    <?php $he = $diferencia->format("%h")-8; ?>
                    {{$diferencia->format($he." houras y %i minutos");}}
                    @else
                        0 horas y 0 minutos
                    @endif
                    @else
                        No registrada
                    @endif
                </td>
                <td>
                    @if (!isset($laboral->entrada->hora))
                    <a class="btn btn-editar" style="color: black" 
                    href="{{route("entrada.cargar",["id"=>$laboral->id])}}">
                        Agregar hora entrada</a>
                    @else
                        @if (!isset($laboral->salida->hora))
                        <a class="btn btn-detalles" style="color: black"
                        href="{{route("salida.cargar",["id"=>$laboral->id])}}"
                        >Agregar hora salida</a>
                        @else
                            
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
