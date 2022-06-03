@extends('plantilla.madre')
@section('titulo')
    Listado de Calendario De Turnos
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
   @can('calendario_nuevo')
   <button class="btn btn-nuevo" onclick="window.location='{{route('calendario.create')}}'"><i class="fa-solid fa-folder-plus"></i> Agregar semana</button>
   @endcan

    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" style="text-align: center">N°</th>
            <th scope="col" class="sorting" style="text-align: center">Inicio de semana</th>
            <th scope="col" class="sorting" style="text-align: center">fin de semana</th>
            <th scope="col" class="sorting" style="text-align: center">Numero de empleado</th>
            @can('calendario_detalle')
                <th scope="col" style="text-align: center">Detalle</th>
            @endcan
                @can('calendario_editar')
                <th scope="col" style="text-align: center">Editar</th>
            @endcan

        </tr>
        </thead>

        <tbody>
            <?php $i=0;?>
        @foreach ($calendarios as $calendario)
        <?php
        $fecha_actual = date("Y-m-d");
        $i++;
        ?>
            <tr>
                <td >{{$i}}</td>
                <td style="text-align: center">{{date("d-m-Y", strtotime($calendario->semana->fecha_inicio));}}</td>
                <td style="text-align: center">{{date("d-m-Y", strtotime($calendario->semana->fecha_final));}}</td>
                <td style="text-align: center"><?php $n=0;?>
                    @foreach ($calendario->detalles as $detalle)
                        <?php $n++;?>
                    @endforeach
                    {{$n}}</td>

                   @can('calendario_detalle')
                    <td>
                        <center>
                            <a class="btn btn-detalles" href="{{route("calendario.show",["id"=>$calendario->id])}}"><i class="fa-solid fa-circle-info"></i></a>
                        </center>
                    </td>
                @endcan


                    @can('calendario_editar')
                    <td>

                        @if ($calendario->semana->fecha_inicio > $fecha_actual)
                            <center>
                                <a class="btn btn-editar" href="{{route("calendario.edit",["id"=>$calendario->id])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                            </center>
                        @endif
                    </td>
                    @endcan

            </tr>
        @endforeach
        </tbody>
    </table>
@stop
