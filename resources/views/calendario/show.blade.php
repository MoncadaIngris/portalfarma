@extends('plantilla.madre')
@section('titulo')
    Detalle de Calendario De Turnos
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

    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">N°</th>
            <th scope="col" class="sorting" style="text-align: center">Inicio de semana</th>
            <th scope="col" class="sorting" style="text-align: center">fin de semana</th>
            <th scope="col" class="sorting" style="text-align: center">Numero de empleado</th>


        </tr>
        </thead>

        <tbody>
        <?php $i=0;?>

            <?php
            $fecha_actual = date("Y-m-d");
            $i++;
            ?>
            <tr>
                <td >{{$i}}</td>
                <td style="text-align: center">{{date("d-m-Y", strtotime($calendario->semana->fecha_inicio))}}</td>
                <td style="text-align: center">{{date("d-m-Y", strtotime($calendario->semana->fecha_final))}}</td>
                <td style="text-align: center"><?php $n=0;?>
                    @foreach ($calendario->detalles as $detalle)
                        <?php $n++;?>
                    @endforeach
                    {{$n}}</td>
            </tr>
        </tbody>

        <div  style="margin: 0 auto;">
            <button class="btn btn-regresar" type="button" onclick="window.location='{{route('calendario.index')}}'">Regresar</button>
        </div>
    </table>
@stop



