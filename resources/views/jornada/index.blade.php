@extends('plantilla.madre')
@section('titulo')
    Listado de jornadas
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
    @can('jornada_nuevo')
    <button class="btn btn-nuevo" onclick="window.location='{{route('jornada.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar Jornada</button>
    @endcan
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center">Nombre</th>
            <th scope="col" class="sorting" style="text-align: center">Maximo de empleados</th>
            <th scope="col" class="sorting" style="text-align: center">Hora de entrada</th>
            <th scope="col" class="sorting" style="text-align: center">Hora de salida</th>
            <th scope="col" class="sorting" style="text-align: center">Horas laborales</th>
            @can('jornada_editar')
            <th scope="col" style="text-align: center">Editar</th>
            @endcan
        </tr>
        </thead>

        <tbody>
        @foreach ($jornadas as $jornada)
            <tr>
                <?php 
                    $hora1 = $jornada->hora_entrada;
                    $hora2 = $jornada->hora_salida;

                    $inicio = new DateTime($hora1);
                    $final = new DateTime($hora2);

                    $diferencia = $inicio->diff($final);

                ?>
                <td>{{$jornada->nombre}}</td>
                <td>{{$jornada->numero_empleados}}</td>
                <td>{{$jornada->hora_entrada}}</td>
                <td>{{$jornada->hora_salida}}</td>
                <td>
                    <?php
                    if ($final->format('H') > $inicio->format('H')){
                        $hora = $final->format('H')-$inicio->format('H')-1;
                    }else{
                        $hora = 24 - $inicio->format('H') + $final->format('H')-1;
                    }

                    $minutos = 60-$inicio->format('i')+$final->format('i');
                    
                    if ($minutos == 60) {
                        $minutos = 0;
                        $hora ++;
                    } else {
                        if ($minutos > 60) {
                            $minutos = $minutos - 60;
                            $hora ++;
                        }                        
                    }
                    
                    ?>
                    {{$hora}} horas y {{$minutos}} minutos
                </td>
                @can('jornada_editar')
                <td>
                    <center>
            <a class="btn btn-editar" href="{{route("jornada.edit",["id"=>$jornada->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    </center>
                </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
