@extends('plantilla.madre')
@section('titulo')
    Listado de planillas
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
        @else
            @if (isset($error))
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
            @endif
        @endif
    @endif

    <form method="post">
        @csrf
        <button class="btn btn-nuevo" type="submit">Generar planilla</button>
    </form>
    <br><br>
    <table  id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="sorting" style="text-align: center; width: 20%">Fecha de inicio</th>
            <th scope="col" class="sorting" style="text-align: center; width: 12%">Fecha final</th>
            <th scope="col" class="sorting" style="text-align: center; width: 12%">Total de empleados</th>
            <th scope="col" class="sorting" style="text-align: center; width: 12%">Total de planilla</th>
            <th scope="col" style="text-align: center; width: 12%">Detalles</th>
        </tr>
        </thead>

        <tbody>
        @foreach($planilla as $plani)
        <tr>
            <td>{{$plani->fecha_inicio}}</td>
            <td>{{$plani->fecha_final}}</td>
            <td>{{count($plani->detalles)}}</td>
            <td>
                <?php $sum = 0?>
                @foreach ($plani->detalles as $p)
                <?php 
                    $sum= $sum + (($p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                    $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                    $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                    $p->hora_extra_sabado)*$p->precio_hora)-((($p->hora_ordinaria_lunes + $p->hora_extra_lunes+$p->hora_ordinaria_martes + 
                    $p->hora_extra_martes+$p->hora_ordinaria_miercoles + $p->hora_extra_miercoles+$p->hora_ordinaria_jueves + 
                    $p->hora_extra_jueves+$p->hora_ordinaria_viernes + $p->hora_extra_viernes+$p->hora_ordinaria_sabado + 
                    $p->hora_extra_sabado)*$p->precio_hora)*0.025);
                ?>
                @endforeach
                L. {{number_format($sum,2)}}
            </td>
            <td style="text-align: center">
                <a class="btn btn-detalles" href="{{route("planilla.show",["id"=>$plani->id])}}"><i class="fa-solid fa-circle-info"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@stop
